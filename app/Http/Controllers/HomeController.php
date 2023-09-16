<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifications;
use App\Models\UserNotificationMappings;
use App\Models\User;
use Illuminate\Support\Facades\DB;

require(__DIR__ . '/../../helper.php');

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $loginId = Auth::user()->id;

        $totalUsers = User::with('userNotifications')->where('id','!=',$loginId)->get(array('id','name','email','phone','created_at'))->toArray();

        $totalNotifications = Notifications::get(array('id','title','type','expiration','created_at'))->toArray();

        return view('home', compact('totalUsers','totalNotifications'));
    }

    public function notifications()
    {
        $totalNotifications = Notifications::with('userNotifications')->get(array('id','title','type','shortText','expiration','created_at'))->toArray();

        return view('notification.list', compact('totalNotifications'));
    }

    // create new notification
    public function addNotification()
    {
        $loginId = Auth::user()->id;

        $totalUsers = User::where('id','!=',$loginId)->where('notificationSwitch','=','1')->get(array('id','name'))->toArray();

        return view('notification.add', compact('totalUsers'));
    }

    // save new notification
    public function saveNotification(Request $request)
    {
        $postData = $request->toArray();

        $notification = Notifications::create([
            'title' => $postData['title'],
            'type' => $postData['type'],
            'shortText' => $postData['shortText'],
            'expiration' => date('Y-m-d', strtotime($postData['expiration']))
        ]);

        $notificationId = $notification->id;

        $mappings = [];

        $all = [];

        foreach($postData['users'] as $user) {
            $mappings['userId'] = $user;
            $mappings['notificationId'] = $notificationId;
            $all[] = $mappings;
        }

        UserNotificationMappings::insert($all);

        return redirect(route('notifications'))->with(['success' => 'notification sent successfully...']);

    }

    // update user profile
    public function updateUserProfile(Request $request)
    {
        $postData = $request->toArray();

        $userId = $postData['id'];

        $update = [];

        $update['name'] = $postData['name'];
        $update['notificationSwitch'] = (!empty($postData['notificationSwitch']) && $postData['notificationSwitch'] == 'on') ? '1' : '0';
        $update['email'] = $postData['email'];
        $update['phone'] = $postData['phone'];

        User::where('id',$userId)->update($update);

        return redirect()->to('getUserProfile/'.$userId)->with(['success' => 'Your profile is updated successfully...']);

    }

    // Get user profile
    public function getUserProfile($id)
    {
        $user = User::where('id',$id)->get(array('id','name','email','phone','notificationSwitch','otpVerified'))->first();

        $date = date('Y-m-d H:i:s');

        $userNotifications = [];

        $userUnreadNotifications = UserNotificationMappings::join('notifications', 'notifications.id', '=', 'user_notification_mappings.notificationId')
        ->where('userId', '=', $id)
        ->where('isRead', '=', '0')
        ->where('expiration', '>=', $date)
        ->get(array('notifications.*','userId'))->toArray();

        return view('users.profile', compact('user','userUnreadNotifications','userNotifications'));

    }

    // mark notification to read and read time when clicked
    public function updateUserNotifications($id, $userId)
    {

        $update = [];

        $update['isRead'] = '1';
        $update['readTime'] = date('Y-m-d H:i:s');
        UserNotificationMappings::where('notificationId',$id)->where('userId',$userId)->update($update);

        return back()->with(['success' => 'Your notification is marked read successfully...']);

    }

    // only read notification and not expired notification will be displayed
    public function getUserNotifications($id)
    {
        $user = User::where('id',$id)->get(array('id','name'))->first();

        $date = date('Y-m-d H:i:s');

        $userUnreadNotifications = UserNotificationMappings::join('notifications', 'notifications.id', '=', 'user_notification_mappings.notificationId')
        ->where('userId', '=', $id)
        ->where('isRead', '=', '0')
        ->where('expiration', '>=', $date)
        ->get(array('notifications.*','userId'))->toArray();

        $userNotifications = UserNotificationMappings::join('notifications', 'notifications.id', '=', 'user_notification_mappings.notificationId')
        ->where('userId', '=', $id)
        ->where('isRead', '=', '1')
        ->where('expiration', '>=', $date)
        ->get(array('notifications.*','userId'))->toArray();

        //pr($userNotifications);

        return view('users.notifications', compact('user','userNotifications','userUnreadNotifications'));

    }

    public function sendOtp(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->toArray();

            $sms_number = '91' . $data['phone'];
            $otp_val = rand(111110, 999999);

            $sms_text = '<#> Dear User, Your Auro scholar OTP is ' . $otp_val . '. Use this to verify your mobile number. AURO-SCHOLAR'. PHP_EOL . '2hf23mGvrVO';

            $template_id = '1507164620315663224';

            $sms_user = 'auroscotp';
            $sms_pass = 'Nsts@321';
            $sms_senderid = 'AUROSC';
            $sms_text_encode = rawurlencode($sms_text);

            $curlurl = 'http://www.smsjust.com/blank/sms/user/urlsms.php?username=' . $sms_user . '&pass=' . $sms_pass . '&senderid=' . $sms_senderid . '&dest_mobileno=' . $sms_number . '&message=' . $sms_text_encode . '&response=Y&dlttempid=' . $template_id;

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $curlurl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));
            $curl_return = curl_exec($curl);
            //$response = json_decode($curl_return, true);
            curl_close($curl);

            echo json_encode(array("status" => "success", "error" => false, "otp" => $otp_val));

        }
    }

    // verify otp
    public function verifyOtp(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->toArray();

            $id = $data['userId'];
            $phone = $data['phone'];

            $update['otpVerified'] = '1';
            $update['phone'] = $phone;

            User::where('id',$id)->update($update);

            echo json_encode(array("status" => "success", "message" => "User verified"));

        }
    }
}

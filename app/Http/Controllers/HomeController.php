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

        $totalUsers = User::where('id','!=',$loginId)->get(array('id','name','email','phone','created_at'))->toArray();

        $totalNotifications = Notifications::get(array('id','title','type','expiration','created_at'))->toArray();

        return view('home', compact('totalUsers','totalNotifications'));
    }

    public function notifications()
    {
        $totalNotifications = Notifications::get(array('id','title','type','shortText','expiration','created_at'))->toArray();

        return view('notification.list', compact('totalNotifications'));
    }

    public function addNotification()
    {
        $loginId = Auth::user()->id;

        $totalUsers = User::where('id','!=',$loginId)->get(array('id','name'))->toArray();

        return view('notification.add', compact('totalUsers'));
    }

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

    public function getUserProfile($id)
    {
        $user = User::where('id',$id)->get(array('id','name','email','phone','created_at'))->first();

        $date = date('Y-m-d H:i:s');

        $userNotifications = [];

        $userUnreadNotifications = UserNotificationMappings::join('notifications', 'notifications.id', '=', 'user_notification_mappings.notificationId')
        ->where('userId', '=', $id)
        ->where('isRead', '=', '0')
        ->where('expiration', '>=', $date)
        ->get(array('notifications.*','userId'))->toArray();

        return view('users.profile', compact('user','userUnreadNotifications','userNotifications'));

    }

    public function updateUserNotifications($id, $userId)
    {
        $update = [];

        $update['isRead'] = '1';
        $update['isRead'] = date('Y-m-d H:i:s');
        UserNotificationMappings::where('id',$id)->update($update);

        return redirect()->to('getUserProfile/'.$userId)->with(['success' => 'Your notification is marked read successfully...']);

    }

    public function getUserNotifications($id)
    {
        $user = User::where('id',$id)->get(array('id','name'))->first();

        $unreadNotifications = UserNotificationMappings::where('userId',$id)->where('isRead','0')->count();

        if($unreadNotifications > 0) {

            $update = [];

            $update['isRead'] = '1';
            $update['isRead'] = date('Y-m-d H:i:s');
            UserNotificationMappings::where('id',$id)->where('isRead','0')->update($update);
        }

        $userUnreadNotifications = [];

        $userNotifications = UserNotificationMappings::join('notifications', 'notifications.id', '=', 'user_notification_mappings.notificationId')
        ->where('userId', '=', $id)
        ->get(array('notifications.*','userId'))->toArray();

        return view('users.notification', compact('user','userNotifications','userUnreadNotifications'));

    }
}

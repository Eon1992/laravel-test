<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notifications extends Model
{
    protected $table = "notifications";

    protected $primaryKey = 'id';

    protected $fillable = [
        'title','type','shortText','expiration'
    ];

    public function userNotifications(){
        return $this->hasMany(UserNotificationMappings::class,'notificationId','id');
    }

}

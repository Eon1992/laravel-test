<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserNotificationMappings extends Model
{
    protected $table = "user_notification_mappings";

    protected $fillable = [
        'userId','notificationId','isRead','readTime'
    ];

    public $timestamps = false;


    /**
     * Get the user that owns the phone.
     */
    public function notifications(): BelongsTo
    {
        return $this->belongsTo(Notifications::class,'notificationId','id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class,'userId','id');
    }

}

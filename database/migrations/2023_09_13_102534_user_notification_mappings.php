<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserNotificationMappings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notification_mappings', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->integer('notificationId');
            $table->enum('isRead', ['0', '1'])->default('0')->comment('0->Not Read, 1->Read');
            $table->dateTime('readTime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_notification_mappings');
    }
}

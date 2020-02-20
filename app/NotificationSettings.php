<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationSettings extends Model
{
    protected $table = 'notification_settings';
    public $timestamps = false;
    
    protected $fillable = [
        'name', 'number_freq', 'frequency', 'cron', 'enabled',
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];
}

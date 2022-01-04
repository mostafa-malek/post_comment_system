<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    # لابد من ذكر اسم الجدول الذي تريد من الموديل التحكم فيه
    protected $table = 'profile_users';
    protected $fillable = [
        'website',
        'user_id',
        'gender',
        'bio'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
        #   الفانكشن ينتمى الى اسم ملف الموديل يوزر ووسيلة الربط الفورينكي
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [

        'description',
        'user_id',
        'parent_id',
        'post_id',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
        #   الفانكشن ينتمى الى اسم ملف الموديل يوزر ووسيلة الربط الفورينكي
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Comment', 'parent_id');
        #   الفانكشن ينتمى الى اسم ملف الموديل يوزر ووسيلة الربط الفورينكي
    }
}

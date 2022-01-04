<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    # اضافة السوفت ديليت للفانكشن
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'is_approved',
        'photo',
        'slug',
    ];

    protected $dates = ['deleted_at'];
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
        #   الفانكشن ينتمى الى اسم ملف الموديل يوزر ووسيلة الربط الفورينكي
    }

    public function tag()
    {
        return $this->belongsToMany('App\Models\Tag');
        #   الفانكشن ينتمى الى اسم ملف الموديل تاج ووسيلة الربط الفورينكي
    }

    public function comment()
    {
        return $this->belongsToMany('App\Models\Comment');
        #   الفانكشن ينتمى الى اسم ملف الموديل كومنت ووسيلة الربط الفورينكي
        # سيجلب الكومنتات التي ليس لها اب بمعنى انها تابعة للبوست وليس رد على كومنت
    }
}

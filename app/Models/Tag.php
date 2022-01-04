<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'tag',
    ];
    protected function post()
    {
        return $this->belongsToMany('App\Models\Post');
    }
}

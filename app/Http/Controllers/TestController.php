<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $my_array = ['php', 'python', 'laravel', 'django'];
        # تستطيع اضافة متغير واستخدامه داخل الصفحة المستدعاه
        return view('test')->with('languages', $my_array);
    }
    public function index()
    {
        return view('test');
    }
}

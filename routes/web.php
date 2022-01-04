<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* انواع الراوت 
  * Route::get لروابط الصفحات ولا يحمل داتا حساسة
  * Route::post يتعامل مع عمليات البيانات وتعاملها مع الداتابيز
  * Route::put في حالة تعديل البيانات ويمكن الاستيعاض عنه بالبوست
  * Route::delete في حالة مسح داتا ويمكن الاستيعاض عنه بالبوست
  * Route::option
  * Route::patch

*/
# البارميتر الاول ياخذ مسار , البارميتر الثاني ياخذ افانكشن تعرض المحتوى المراد
#Route::get('/', function () {
#    return view('ff');
#});

Route::get('/test', function () {

    # هنا يتم عرض محتوى الرابط سواء كان ملف يتم استدعاؤه او كود يتم كتابته
    # تم استدعاء صفحة التيست التي في الفيو 
    return view('test');
})->name('t');


# {name} يمكن حمل بارميتر مع اللينك بشكل اجباري بحيث انه اذا لم يتم وضع باراميتر سينتج خطأ
Route::get('param/{name}', function ($name) {

    # قمت باستخدام البارميتر الي سيتم اضافته مع الرابط 
    # يمكن ان يستخدم في عرض  صفحةمنتج معين من خلال الاي دي
    return  "welcome Mr " . $name;
})->name("prm");

# {id?} يمكن حمل بارميتر مع اللينك بشكل اختياري بحيث انه اذا لم يتم وضع باراميتر لن ينتج خطأ
Route::get('param2/{id?}', function () {

    # قمت باستخدام البارميتر الي سيتم اضافته مع الرابط 
    # يمكن ان يستخدم في عرض  صفحةمنتج معين من خلال الاي دي
    return  "your id is ";
})->name("prm2");
#اعطاء الراوت اسم مميز ومختصر لسهولة استدعاؤه من خلال ذلك الاسم المستعار  بدلا من كتابة الرابط

# طريقةاخرى لكتابة راوت
Route::view('man', 'posts.index');

#  طريقةاخرى لكتابة راوت بالكنترولر
# الاول ياخذ اسم المسار والثاني ياخذ اسم الكنترولر وبعد أت يتم استدعاء اسم الفانكشن
Route::get('index', 'App\Http\Controllers\PostController@index');




# اختصار بدلا من كتابة get or delete or update or create
# بعدها سيقوم بتحديد العمليه المراده من خلال ما ياتي بعد السلاش
#تم اضافة اوث حتى لايفتح الرابط الا اذا سجل دخول
Route::resource('posts', 'App\Http\Controllers\PostController')->middleware('auth');

#عمل راوت لتعرف لينك السوفت ديليت واضافة اي دي له 
#وتعيين اسم للراوت من خلال فانكشن 
Route::get('posts/soft/delete/{id}', 'App\Http\Controllers\PostController@softdelete')->name('soft.delete')->middleware('auth');

# عمل راوت لصفحة الداتا الممسوحة وعرضها
Route::get('posts.archive', 'App\Http\Controllers\PostController@archive')->name('posts.archive')->middleware('auth');

# عمل راوت لصفحة الداتا ارجاع الداتا الممسوحة
Route::get('posts.restore{id}', 'App\Http\Controllers\PostController@restore')->name('posts.restore')->middleware('auth');

Route::get('tags.show_tags{id}', 'App\Http\Controllers\TagController@show_tags')->name('tags.tags')->middleware('auth');


Route::get('/', 'App\Http\Controllers\HomeController@index');




# سيقوم بعرض البروفايل
Route::get('/profile', 'App\Http\Controllers\ProfileController@index')->name('profile')->middleware('auth');

# سيقوم بتحديث البروفايل
Route::put('/profile/update', 'App\Http\Controllers\ProfileController@update')->name('profile.update')->middleware('auth');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');



Auth::routes();



Route::resource('tags', 'App\Http\Controllers\TagController')->middleware('auth');


Route::resource('comments', 'App\Http\Controllers\CommentsController')->middleware('auth');

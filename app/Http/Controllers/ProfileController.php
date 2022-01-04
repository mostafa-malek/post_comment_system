<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

# استدعاء معلومات اليوزر الذي سيقوم بعمل لوجين من مكتبة اوث
use Illuminate\Support\Facades\Auth;

# ربط ملف البروفايل موديل لاستدعاء بياناته هنا
use App\Models\Profile;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        #تخزين معلومات اليوزر الذي قام بعمل لوجين داخل متغير 
        $user = Auth::user();
        # تخزين أي دي اليوزر الذي قام باللوجين داخل متغير
        $id = Auth::id();
        # كل يوزر جديد عند التسجيل لن يكون له بروفايل 
        #ساقوم بعمل شرط اذا لم يكن لليوزر بروفايل اصنع له بروفايل
        # يوزر هنا استدعى فانكشن بروفايل الموجودة في موديل اليوزر والتي تربطها بموديل بروفايل
        if ($user->profile == null) {
            #انشىء بروفايل لليوزر واضف المعلومات الافتراضية ليقوم بتعديلها هو 
            $create_profile = Profile::create([
                'website' => 'https://your website.com',
                'user_id' => $id,
                'gender'  => 'Male',
                'bio'     => 'Your Bio',
            ]);
        }
        # توجيه الشخص الى صفحة بروفايل بالاضافة الى معلومات اليوزر
        #لاستخدامها في عرض بياناته 
        #بذلك لن يستطيع تغيير الاي دي والاطلاع على باقي البروفايلات
        return view('users.profile')->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) #قمت بحذف الاي دي لاني ساجلبه من الاوث
    {
        #عمل فاليديت للتاكد من ادخال القيم
        $this->validate($request, [
            'name' => 'required',
            'website' => 'required',
            'gender'  => 'required',
            'bio'     => 'required',
        ]);
        # طالما اليوزر قام بعمل لوجين استطيع تحصيل معلوماته من خلال الاوث
        $user = Auth::user();
        $user->name = $request->name;
        #سأستعين بالفانكشن الموجودة في موديل اليوزرز وهي بروفايل لتمرير الداتا لجدول البروفايل
        $user->profile->website = $request->website;
        $user->profile->gender = $request->gender;
        $user->profile->bio = $request->bio;
        $user->save();
        $user->profile->save();
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

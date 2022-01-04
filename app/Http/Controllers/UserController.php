<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    # لعدم التمكن من اجراء اي عملية من العمليات التالية الا بعد عمل لوجين
    /*public function __construct()
    {
        $this->middleware('Auth');
    }
    */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8',],
        ]);
        $add_user = User::create([
            'name' => $request->name,
            'email' =>  $request->email,
            'password' =>   Hash::make($request->password),
        ]);
        $create_profile = Profile::create([
            'website' => 'www.your website.com',
            'user_id' => $add_user->id,
            'gender'  => 'Male',
            'bio'     => 'Your Bio',
        ]);
        return Redirect()->route('users.index')->with('success', 'user added');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        #احذف البروفايل الخاص به قبل ان تحذف اليوزر بالكامل
        $user->profile->delete($id);
        $user->delete();
        return Redirect()->route('users.index')->with('delete', 'user deleted');
    }
}

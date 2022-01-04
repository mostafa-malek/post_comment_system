<?php

namespace App\Http\Controllers;

#لاستخدام str::slug

use App\Models\Comment;
use Illuminate\Support\Str;

use App\Models\Post;
#استدعاء جدول التاج
use App\Models\Tag;

use Illuminate\Http\Request;
#تم استدعاءاوث لجلب بيانات اليوزر الذي قام باللوجين
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /*protected function __construct()
    {
        $this->middleware('auth');
    }*/
    #يستخدم لعرض البينات من الداتابيز 
    public function index()
    {
        # امر سيتخدم لجلب اخر ما تم ادخال من البوستات وعرضه في باجينيشن واختيار عدد النتائج في كل صفحة
        $all_posts = Post::latest()->paginate(5);
        #سيقوم بارسال المتغير داخل صفحة البوست بكل محتواه لا ستخدامه داخلها
        return view('posts.index', compact('all_posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        if ($tags->count() == 0) {
            return redirect()->route('tags.create');
        }
        return view('posts.create', compact('tags', $tags));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # التأكد من ان القيم غير فارغة
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'is_approved' => 'required',
            'photo' => 'required|image',
            'tags' => 'required',
        ]);

        #التعامل مع الصور
        #تخزين اسم الصورة في متغير
        $photo = $request->photo;


        #عمل اسم عشوائي للاسم الاصلي للصورة حتى لا تتكرر الاسماء ويحدث استبدال للصور
        #سيقوم بعمل وقت الادخال +الصورة + اسم الصورة الاصلي الذي ادخله اليوزر
        $newphoto = time() . $photo->getClientOriginalName();

        #تحديد مكان رفع الصورة في الباراميتر الاول واسم الصورة في البارميتر الثاني
        $photo->move('uploads/post', $newphoto);
        $slug = $request->title . "-" . Auth::id();
        $add_post = Post::create([
            #سياخذ الاي دي من اليوزر الذي قام بعمل لوجين لاسناذ البوست اليه
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'is_approved' => $request->is_approved,
            # الصورة تاخذ مسار 
            'photo' => 'uploads/post/' . $newphoto,
            # هنا سيقوم بتوليد سلوج عشوائي يتضمن عنوان البوست لاستخدامه كرابط عند عرض محتوى البوست
            'slug' => Str::slug($slug)

        ]);

        #اضافة  اي ديهات التي تم اختيارها الىالتاجات في جدول التاج
        $add_post->tag()->attach($request->tags);

        return redirect()->route('posts.index')
            ->with('success', 'successfully added');
        # الاول ياخذ اسم السيشن الذي ساستدعيه في ملف الفرونت
        #الثاني ياخذ محتوى السيشن وهو هنا رسالة نجاح
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        #سيقوم بجلب البوست من خلال
        $display = Post::where('slug', $slug)->first();
        $comments = Comment::all()->where('parent_id', '==', null)->where('post_id', '==', $display->id);
        // $replies = Comment::all()->where('parent_id', '==', true);
        return view('posts.show', compact('display', $display))->with('comments', $comments)
            /*->with('replies', $replies)*/;
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::all();
        $get_data = Post::where('id', $id)->where('user_id', Auth::id())->first();
        if ($get_data == null) {
            return Redirect()->back();
        }
        return view('posts.edit')->with('get_data', $get_data)->with('tags', $tags);
        #طريقة اخرى لعل ريترن نفس النتيجة
        #view('posts.edit'->with('get_data',$get_data));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        #تخزين الداتا المجلوبة من الداتابيز بالاي دي في متغير
        $edite_post = Post::where('id', $id)->first();

        #عمل فحص للداتا المجلوبة من اليوزر
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'is_approved' => 'required',
        ]);
        if ($request->has('photo')) {
            $photo = $request->photo;
            #عمل اسم عشوائي للاسم الاصلي للصورة حتى لا تتكرر الاسماء ويحدث استبدال للصور
            #سيقوم بعمل وقت الادخال +الصورة + اسم الصورة الاصلي الذي ادخله اليوزر
            $newphoto = time() . $photo->getClientOriginalName();

            #تحديد مكان رفع الصورة في الباراميتر الاول واسم الصورة في البارميتر الثاني
            $photo->move('uploads/post', $newphoto);
            #اسناد الرابط للريكويست القادم الخاص بالصورة وتخزينه في الداتابيز
            $edite_post->$photo = 'uploads/post' . $newphoto;
        }

        $edite_post->title = $request->title;
        $edite_post->description = $request->description;
        $edite_post->is_approved = $request->is_approved;
        # لابقاء الاختيارات كما هي في حالة عدم التحديث او تغييرها في حالة التغيير
        $edite_post->tag()->sync($request->tags);

        $edite_post->save();

        return redirect()->back()
            ->with('success', 'successfully updated');
    }



    # عمل مسح للداتا غير نهائي
    public function softdelete($id)
    {
        $del = Post::where('id', $id)->where('user_id', Auth::id())->first();
        if ($del == true) {
            $del->delete();
            return redirect()->back()
                ->with('success', 'successfully archived');
        } else {
            return redirect()->back()->with('failed', 'you have no permission');
        };
    }

    # عمل فانكشن لاستقبال الداتا اللممسوحة 
    public function archive()
    {
        # امر سيتخدم لجلب اخر ما تم ادخال من البوستات وعرضه في باجينيشن واختيار عدد النتائج في كل صفحة
        $all_archive = Post::onlyTrashed()->where('user_id', Auth::id())->paginate(5);
        #سيقوم بارسال المتغير داخل صفحة البوست بكل محتواه لا ستخدامه داخلها
        return view('posts.archive', compact('all_archive'));
    }

    public function restore($id)
    {
        #ارجاع البوست للعرض 
        $restore = Post::onlyTrashed()->where('id', $id)->first()->restore();
        return redirect()->route('posts.index')
            ->with('success', 'successfully restored');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $del = Post::withTrashed()->where('id', $id)->where('user_id', Auth::id())->first();
        $del->forceDelete();
        return redirect()->route('posts.index')
            ->with('success', 'successfully deleted');
    }
}

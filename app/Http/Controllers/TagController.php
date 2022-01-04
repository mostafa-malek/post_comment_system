<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # امر سيتخدم لجلب اخر ما تم ادخال من البوستات وعرضه في باجينيشن واختيار عدد النتائج في كل صفحة
        $all_tags = Tag::latest()->paginate(5);
        #سيقوم بارسال المتغير داخل صفحة البوست بكل محتواه لا ستخدامه داخلها
        return view('tags.index', compact('all_tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
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
            'tag' => 'required',

        ]);
        $add_tag = Tag::create([
            'tag' => $request->tag,

        ]);
        return redirect()->route('tags.index')
            ->with('success', 'successfully added');
        # الاول ياخذ اسم السيشن الذي ساستدعيه في ملف الفرونت
        #الثاني ياخذ محتوى السيشن وهو هنا رسالة نجاح
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        #سيقوم بجلب البوست من خلال
        $display = Tag::where('id', $id)->first();
        return view('tags.show', compact('display', $display));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $get_data = Tag::where('id', $id)->first();
        return view('tags.edit', compact('get_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $edite_tag = Tag::where('id', $id)->first();

        #عمل فحص للداتا المجلوبة من اليوزر
        $this->validate($request, [
            'tag' => 'tag',

        ]);
        $edite_tag->tag = $request->tag;
        $edite_tag->save();

        return redirect(view('tags.index'))
            ->with('success', 'successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Tag::where('id', $id)->first();
        $del->Delete();
        return redirect()->route('tags.index')
            ->with('success', 'successfully deleted');
    }
    public function show_tags(Request $request, $id)
    {
        $resaults = Tag::where('id', $id)->first();

        return view('tags.show_tags', compact('resaults', $resaults));
    }
}

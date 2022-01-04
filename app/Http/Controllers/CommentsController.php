<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'user_id' => 'required',
            'post_id' => 'required',
            'parent_id' => 'nullable'
        ]);
        if ($request->parent_id == null) {
            $request->parent_id = null;
        }
        $create_comment = Comment::create([
            'description' => $request->description,
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comments
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comments)
    {
        $all_comments = Comment::where('post_id');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comments
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($topic,$post)
    {
        $post = Post::findOrFail($post);
		return $post->comments(function($subquery){
			$subquery->orderBy('created_at','asc');
		})->paginate(20);
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
    public function store(Request $request,$topic,$post)
    {
        $post = Post::findOrFail($post);
		$newComment = $post->comments()->create([
			'creator'=>Auth::user()->id
			,'body'=>$request->input('body')
		]);
		return $newComment;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($topic,$post,$comment)
    {
        $comment = Comment::findOrFail($comment);
		return $comment;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
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
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$topic,$post,$comment)
    {
        $comment = Comment::findOrFail($comment);
		$comment->update([
			'body'=>$request->input('body')
		]);
		return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        return $comment->delete();
    }
}

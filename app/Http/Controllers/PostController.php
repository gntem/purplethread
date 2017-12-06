<?php

namespace App\Http\Controllers;

use App\Post;
use App\Topic;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$topic)
    {
        if($request->ajax()){
            $topic = Topic::findOrFail($topic);
            return $topic->posts(function($subquery){
                $subquery->orderBy('created_at','desc');
            })->paginate(20);
        }
        return view('topic_posts')->with(['topicId'=>$topic]);
        
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
    public function store(Request $request,$topic)
    {
		$topic = Topic::findOrFail($topic);
		$newPost = $topic->posts()->create([
            'creator'=>Auth::user()->id
			,'title'=>$request->input('title')
			,'body'=>$request->input('body')
			,'ttl'=>$request->input('ttl')
        ]);
		return $newPost;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($topic,$post)
    {
		$post = Post::findOrFail($post);
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$topic,$post)
    {
		$post = Post::findOrFail($post);
        $post->update([
			'body'=>$request->input('body')
		]);
		return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        return $post->delete();
    }
}

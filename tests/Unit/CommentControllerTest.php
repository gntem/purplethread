<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Post;
use App\Topic;
use App\Comment;

class CommentControllerTest extends TestCase
{
	use RefreshDatabase;
	use WithoutMiddleware;
	
	public function testCommentControllerIndex(){
		$post = factory(\App\Post::class)->create()->first();
		$comments = factory(\App\Comment::class,22)->create([
			'post'=>$post->id
		]);
		
		$responseFirstPage = $this->get('/topic/'.$post->topic.'/post/'.$post->id.'/comments');
        
        $responseFirstPage->assertJson([
            'per_page'=>20
            ,'from'=>1
            ,'to'=>20
            ,'current_page'=>1
            ,'data'=>$comments->slice(0,20)->toArray()
		]);
	}
	
	public function testCommentControllerStore(){
		$post = factory(\App\Post::class)->create([
            'title'=>'testpost'
            ,'body'=>'testbody'
        ]);
        
		$user = factory(\App\User::class)->create();
		
        $response = $this->actingAs($user)
		->post('/topic/'.$post->topic.'/post/'.$post->id.'/comment/new',[
			'body'=>'new comment body'
        ]);
		
        $response->assertSuccessful();
		
		$response->assertJson([
            'body'=>'new comment body'
		]);
	}

	public function testCommentControllerShow(){
		
		$post = factory(\App\Post::class)->create()->first();
		$comment = factory(\App\Comment::class)->create([
			'post'=>$post->id
		])->first();
		
		$response = $this->get('/topic/'.$post->topic.'/post/'.$post->id.'/comment/'.$comment->id);
        $response->assertSuccessful();
		$response->assertJson($comment->toArray());
        
	}
	
	public function testCommentControllerUpdate(){
		$post = factory(\App\Post::class)->create()->first();
		$comment = factory(\App\Comment::class)->create([
			'post'=>$post->id
		])->first();
		
		$response = $this->put('/topic/'.$post->topic.'/post/'.$post->id.'/comment/'.$comment->id,[
			'body'=>'new body'
		]);
        
		$response->assertSuccessful();
		
		$response->assertJson(['body'=>'new body']);
	}
	
	public function testCommentControllerDelete(){
		$post = factory(\App\Post::class)->create()->first();
		$comment = factory(\App\Comment::class)->create([
			'post'=>$post->id
		])->first();
		
		$response = $this->delete('/topic/'.$post->topic.'/post/'.$post->id.'/comment/'.$comment->id);
		$response->assertSuccessful();
	
	}
}
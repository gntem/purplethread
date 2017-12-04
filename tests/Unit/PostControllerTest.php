<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Post;
use App\Topic;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
    
    public function testPostControllerIndex(){

        $topic = factory(Topic::class,1)->create([
            'title'=>'testtopic'
            ,'description'=>'testdescription'
        ])->first();
        
        $posts = factory(Post::class,22)->create([
            'topic'=>$topic->id
        ]);

        $responseFirstPage = $this->get('/topic/'.$topic->id.'/posts');
        
        $responseFirstPage->assertJson([
            'per_page'=>20
            ,'from'=>1
            ,'to'=>20
            ,'current_page'=>1
            ,'data'=>$posts->slice(0,20)->toArray()
		]);
        
    }
    
    public function testPostControllerCreate(){
        
        $topic = factory(Topic::class)->create([
            'title'=>'testtopic'
            ,'description'=>'testdescription'
        ]);
        
		$user = factory(\App\User::class)->create();
		
        $response = $this->actingAs($user)->post('/topic/'.$topic->id.'/post/new',[
           'title'=>'new post in test topic'
           ,'body'=>'new post body'
           ,'ttl'=>60 
        ]);
		
        $response->assertSuccessful();
		
		$response->assertJson([
           'title'=>'new post in test topic'
            ,'body'=>'new post body'
			,'ttl'=>60
		]);
    }
	
	public function testPostControllerShow(){
		
		$post = factory(Post::class)->create()->first();
		
		$response = $this->get('/topic/'.$post->topic.'/post/'.$post->id);
		
		$response->assertSuccessful();
		
		$response->assertJson($post->toArray());
		
	}
	
	public function testPostControllerUpdate(){
		
		$post = factory(Post::class)->create()->first();
		
		$response = $this->put('/topic/'.$post->topic.'/post/'.$post->id,[
			'body'=>'updatedbody'
		]);
		
		$response->assertSuccessful();
		
		$response->assertJson([
			'id'=>$post->id
			,'body'=>'updatedbody'
		]);
		
	}
	public function testPostControllerDelete(){
		
		$post = factory(Post::class)->create()->first();
		
		$response = $this->delete('/topic/'.$post->topic.'/post/'.$post->id);
		
		$response->assertSuccessful();
		
	}
	
}

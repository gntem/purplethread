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

}

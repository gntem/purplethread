<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Topic;

class TopicControllerTest extends TestCase
{
	use WithoutMiddleware;
	use RefreshDatabase;

    public function testTopicControllerIndexRoute()
    {
        $topics = factory(Topic::class,2)->create();
		
        $response = $this->get('/topics');

        $response->assertSuccessful();
        $response->assertJson($topics->values()->toArray());
    }
    
    public function testTopicControllerStoreRoute(){
        $topic = [
            'title'=>'testingtopic123'
            ,'description'=>'testingdescription123'
        ];
        
        $response = $this->postJson('/topic/new',$topic);
        
        $response->assertSuccessful();
        
        $response->assertJson($topic);
        
        $this->assertDatabaseHas('topics', $topic);
        
        
    }
    public function testTopicControllerShowRoute(){
        $topic = factory(Topic::class,1)->create([
            'title'=>'testshowroute123'
            ,'description'=>'testdescription123'
        ])->first();
		
        $response = $this->get('/topic/'.$topic->id)
                ->assertSuccessful();

        $response->assertJson([
            'id'=>$topic->id
            ,'title'=>$topic->title
            ,'description'=>$topic->description
        ]);
        
    }
    public function testTopicControllerUpdateRoute(){

        $topic = factory(Topic::class)->create([
            'title'=>'testoldtitle'
            ,'description'=>'testolddescription'
        ])->first();
        
        $response = $this->put('/topic/'.$topic->id,[
            'title'=>'testnewtitle'
            ,'description'=>'testnewdescription'
        ])->assertSuccessful();

        $response->assertJson([
           'id'=>$topic->id
           ,'title'=>'testnewtitle'
           ,'description'=>'testnewdescription'
        ]);
        
    }
    public function testTopicControllerDestroyRoute(){
        $topic = factory(Topic::class)->create([
            'title'=>'testoldtitle'
            ,'description'=>'testolddescription'
        ])->first();
        
        $response = $this->delete('/topic/'.$topic->id)
                        ->assertSuccessful();
    }
}

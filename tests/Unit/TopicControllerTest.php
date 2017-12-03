<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TopicControllerTest extends TestCase
{
	use WithoutMiddleware;
	use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $topics = factory(Topic::class,2)->create();
		
		$response = $this->get('/topics');
		
		$response->assertSuccessful();
		
		$response->assertJson([
			[
				'title'=>'test1'
				,'description'=>'test2'
			]
			,[
				'title'=>'test3'
				,'description'=>'test4'
			]
		]);
    }
}

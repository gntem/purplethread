<?php

use Illuminate\Database\Seeder;
use App\Topic;
use App\Post;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topic = factory(Topic::class)->create();
        
        factory(Post::class,30)->create([
            'topic'=>$topic->id
        ]);

    }
}

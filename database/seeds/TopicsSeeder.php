<?php

use Illuminate\Database\Seeder;
use App\Topic;

class TopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Topic::class,10)->create();
    }
}

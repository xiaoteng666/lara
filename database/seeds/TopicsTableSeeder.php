<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        $topics = factory(Topic::class)->times(50)->make()->each(function ($topic, $index) {
            
        });

        Topic::insert($topics->toArray());
    }

}


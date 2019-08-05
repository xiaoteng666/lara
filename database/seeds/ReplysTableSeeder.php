<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\User;
use App\Models\Topic;

class ReplysTableSeeder extends Seeder
{
    public function run()
    {   
    	//所有用户的ID数组
    	$user_ids = User::all()->pluck('id')->toArray();
    	//所有话题的ID数组
    	$topic_ids = Topic::all()->pluck('id')->toArray();
    	// 获取 Faker 实例
        $faker = app(Faker\Generator::class);
        $replys = factory(Reply::class)->times(1000)->make()->each(function ($reply, $index) use ($user_ids,$topic_ids,$faker) {
        	     //随机取一个用户ID
                 $reply->user_id = $faker->randomElement($user_ids);
                 //随机取一个话题ID
                 $reply->topic_id = $faker->randomElement($topic_ids);
        });
          //将数据集合转化为数组，并插入到数据库中
        Reply::insert($replys->toArray());
    }

}


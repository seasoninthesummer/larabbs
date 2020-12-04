<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;

class ReplysTableSeeder extends Seeder
{
    public function run()
    {
        $user_ids = User::all()->pluck('id')->toArray();

        $topic_ids = Topic::all()->pluck('id')->toArray();

        // 获取Faker实例
        $faker = app(Faker\Generator::class);
        $replys = factory(Reply::class)->times(1000)->make()->each(function ($reply, $index)
        use ($user_ids, $topic_ids, $faker) {
            // 从用户id数组中随机获取出一个并赋值
            $reply->user_id = $faker->randomElement($user_ids);

            // 话题ID
            $reply->topic_id = $faker->randomElement($topic_ids);

        });

        // 将数据集合装换为数组，并插入到数据库中
        Reply::insert($replys->toArray());
    }

}


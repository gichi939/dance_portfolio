<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'title' => 'test1',
            'body' => '自己紹介です1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('posts')->insert($param);

        $param = [
            'title' => 'test2',
            'body' => '自己紹介です2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('posts')->insert($param);

        $param = [
            'title' => 'test3',
            'body' => '自己紹介です3',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('posts')->insert($param);

        $param = [
            'title' => 'test4',
            'body' => '自己紹介です4',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('posts')->insert($param);
    }
}

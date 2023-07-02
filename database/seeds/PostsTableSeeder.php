<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'post'=>'サンプル',
            'photo'=>'サンプル',
            'users_id'=>'1',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
    }
}

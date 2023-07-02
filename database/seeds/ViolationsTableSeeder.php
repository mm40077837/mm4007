<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class ViolationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('violations')->insert([
            'users_id'=>'1',
            'posts_id'=>'1',
            'report'=>'サンプル',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

use Carbon\carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'サンプル1',
            'icon'=>'アイコン名',
            'email'=>'サンプル@mail',
            'password'=>'サンプルパスワード',
            'remember_token'=>'サンプルパスワード',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
    }
}

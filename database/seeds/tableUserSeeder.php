<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class tableUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=DB::table('users')->where('email','algo@gmail.com')->first();
   
        if(!$user){
            DB::table('users')->insert([
                'name'=>'algorithme',
                'email'=>'algo@gmail.com',
                'password'=>Hash::make('imedakrouti'),
                'role'=>'admin'
            ]);
        }
        $gravatar=gravatar($user->email);
        db::table('profiles')->insert([
            'user_id'=>$user->id,
            'about'=>'super admin',
             'picture'=>$gravatar,
             'facebook'=>'algorithme',
             'twitter'=>'algorithme'
             ]);
    }
}

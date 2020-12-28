<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'username' => Str::random(10),
            'email_verified_at' => NULL,
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'profilefile' => "default1",
            'about' => "",
            'location'=> "",
            'showmail'=>0,
            'showloc'=>0,
            'posts'=>0

        ]);
    }
}

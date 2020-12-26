<?php

use Illuminate\Database\Seeder;

class ImageUploadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('image_uploads')->insert([
            'filename' => "default",
            'description' => Str::random(10),
            'title' => Str::random(10),
            'user' => "bot",
            'views' => 0,
            'likes' => 0,
            'user_id'=> 6,
            'tags'=>'gay, gay'
        ]);
    }
}

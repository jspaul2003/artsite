<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        for($x=0; $x<=200; $x++) {
            $this->call(UserSeeder::class);
            $this->call(ImageUploadsSeeder::class);
        }
    }
}

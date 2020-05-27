<?php

use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\File::class, 5)->create()->each(function ($post) {
            $post->save();
        });
    }
}

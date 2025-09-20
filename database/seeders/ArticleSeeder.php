<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 4; $i++) {
            $title = $faker->sentence(6); // başlık al
            DB::table('articles')->insert([
                'category_id' => rand(1, 7),
                'title'=>$title,
                'image' => 'https://picsum.photos/800/400?random' . rand(1, 1000),


                'content' => $faker->paragraph(3, true), // daha anlamlı içerik
                'slug' => Str::slug($title), // aynı başlıktan türet
                'created_at' => $faker->dateTime('now'),
                'updated_at' => now(),
            ]);
        }
    }
}

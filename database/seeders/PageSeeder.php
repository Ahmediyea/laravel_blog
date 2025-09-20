<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
     {
        $pages = ["Hakkımızda", "Kariyer", "Vizyonumuz", "Misyonumuz"];
        $count=0;
        foreach ($pages as $page) {
            $count++;

            DB::table("pages")->insert([
                "title" => $page,
                "slug" => Str::slug($page),
                "image" =>'https://th.bing.com/th/id/OIP.AJlpxkMAEZ1QHAKzEuJLIwHaE8?w=237&h=180&c=7&r=0&o=5&dpr=1.5&pid=1.7',
                "content" =>"Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsam velit dolores numquam asperiores laborum perferendis a possimus maiores ipsa quo eius, nulla sit? Perferendis voluptatibus, maiores similique nulla laudantium et!",
                "created_at" =>now(),
                "updated_at" =>now(),
                "order" => $count
            ]);
        }
    }
}

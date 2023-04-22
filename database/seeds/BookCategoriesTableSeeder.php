<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book_categories')->insert([
            [
                'id' => 1,
                'title' => 'Научная фантастика',
                'slug' => 'science-fiction',
            ],
            [
                'id' => 2,
                'title' => 'Фэнтези',
                'slug' => 'fantasy',
            ],
            [
                'id' => 3,
                'title' => 'Романы',
                'slug' => 'novels',
            ],
            [
                'id' => 4,
                'title' => 'Историческая',
                'slug' => 'Historical',
            ],
            [
                'id' => 5,
                'title' => 'Детективы',
                'slug' => 'detectives',
            ],
        ]);
    }
}

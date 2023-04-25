<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                'slug' => Str::slug('Научная фантастика', '_'),
            ],
            [
                'id' => 2,
                'title' => 'Фэнтези',
                'slug' => Str::slug('Фэнтези', '_'),
            ],
            [
                'id' => 3,
                'title' => 'Романы',
                'slug' => Str::slug('Романы', '_'),
            ],
            [
                'id' => 4,
                'title' => 'Историческая',
                'slug' => Str::slug('Историческая', '_'),
            ],
            [
                'id' => 5,
                'title' => 'Детективы',
                'slug' => Str::slug('Детективы', '_'),
            ],
        ]);
    }
}

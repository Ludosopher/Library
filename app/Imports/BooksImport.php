<?php

namespace App\Imports;

use App\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class BooksImport implements ToModel, WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    private $categories;

    public function __construct(iterable $categories)
    {
        $this->categories = $categories;
    }

    public function model(array $row)
    {
        $categories = $this->categories;

        $category_id = 1;
        foreach ($categories as $id => $title) {
            if ($row[3] === $title) {
                $category_id = $id; 
            }
        }
        
        return new Book([
           'title' => $row[0],
           'author' => $row[1],
           'slug' => Str::slug($row[0].' '.$row[1]), 
           'description' => $row[2] ?? '',
           'category_id' => $category_id,
        ]);
    }

    public function chunkSize(): int
    {
        return 100;
    }
}

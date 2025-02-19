<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Thêm thể loại phim
        $genres = ['Hành động', 'Võ thuật', 'Kinh dị', 'Hài hước', 'Tình cảm'];
        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }

        // Thêm 50 bộ phim
        Movie::factory(50)->create();
    }
}

<?php

namespace Database\Factories;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'poster' => $this->faker->imageUrl(200, 300),
            'intro' => $this->faker->text(100),
            'release_date' => $this->faker->date(),
            'genre_id' => Genre::inRandomOrder()->first()->id,
        ];
    }
}

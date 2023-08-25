<?php

namespace Database\Factories;

use Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReportArtistModel>
 */
class ReportArtistModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $usersId = [1, 2];
        $revenues = [20.0, 30.5, 10.5, 11.5, 11.0];

        return [
            'user_id' => Arr::random($usersId),
            'artist_name' => $this->faker->text(50),
            'revenue' => Arr::random($revenues),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}

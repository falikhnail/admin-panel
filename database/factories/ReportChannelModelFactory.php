<?php

namespace Database\Factories;

use Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReportChannelModel>
 */
class ReportChannelModelFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        $usersId = [1, 2];
        $revenues = [20.0, 30.5, 10.5, 11.5, 11.0];

        return [
            'user_id' => Arr::random($usersId),
            'label_name' => $this->faker->name(),
            'channel_name' => $this->faker->text(10),
            'channel_id' => $this->faker->randomAscii(),
            'revenue' => Arr::random($revenues)
        ];
    }
}

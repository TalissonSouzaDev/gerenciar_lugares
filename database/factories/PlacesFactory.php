<?php

namespace Database\Factories;

use App\Models\places;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\places>
 */
class PlacesFactory extends Factory
{
    protected $model = Places::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->name;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
        ];
    }
}

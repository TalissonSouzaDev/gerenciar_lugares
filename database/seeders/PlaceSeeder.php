<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\places;
use Illuminate\Support\Str;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($i=0; $i < 30; $i++) {
            $name = $faker->name;
            places::create([
                'name' => $name,  // Nome fictício
                'slug' => Str::slug($name),     // Slug gerado automaticamente
                'city' => $faker->city,     // Cidade fictícia
                'state' => $faker->stateAbbr,   // Estado fictício
            ]);
        }
    }
}

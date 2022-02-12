<?php

namespace Database\Factories;

use Faker\Provider\Color;
use Faker\Provider\en_US\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition(): array
    {
        $firstNameFemale = Person::firstNameFemale();
        $color = Color::colorName();

        return [
            'name' =>  "$firstNameFemale $color"
        ];
    }
}

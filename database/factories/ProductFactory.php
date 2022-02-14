<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Faker\Provider\Color;
use Faker\Provider\en_US\Person;
use Faker\Provider\pt_BR\Payment;
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
        $brands = Brand::all(['id']);
        $gender = ['masculino', 'feminino'];

        return [
            'model' =>  "$firstNameFemale $color",
            'gender' =>  $gender[random_int(0, 1)],
            'amount' =>  Payment::randomFloat(2, 39, 999),
            'brand_id' => $brands[random_int(0, 3)]->getAttribute('id'),
            'category_id' => Category::query()->first(['id'])->getAttribute('id')
        ];
    }
}

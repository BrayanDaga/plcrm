<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Family;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_families' => Family::inRandomOrder()->first()->id,
            'name' => $this->faker->word()
        ];
    }
}

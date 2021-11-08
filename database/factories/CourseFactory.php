<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'id_categories' => Category::inRandomOrder()->first()->id,
            'title' => $this->faker->jobTitle(),
            'area' => 'vacio',
            'description' => $this->faker->text($maxNbChars = 200),
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
            'currency' => 'ninguno',
            'price' => 250.00,
            'ranking_by_user' => $this->faker->numberBetween(0,5),
            'status' => $this->faker->boolean(),
        ];
    }
}

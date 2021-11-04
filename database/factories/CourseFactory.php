<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Course::class;
    public function definition()
    {
        return [
            'user_id'           => 2,
            'id_categories'     => 1,
            'title'             => $this->faker->sentence(1),
            'area'              => $this->faker->sentence(1),
            'description'       => $this->faker->sentence(10),
            'image'             => 'imagen',
            'currency'          => 'divisa',
            'price'             => $this->faker->randomNumber(),
            'ranking_by_user'   => 1,
            'status'            => 1
        ];
    }
}

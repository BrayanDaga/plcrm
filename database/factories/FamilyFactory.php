<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Family;  

class FamilyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Family::class;
    public function definition()
    {
        return [
            'name' => "familia"
        ];
    }
}

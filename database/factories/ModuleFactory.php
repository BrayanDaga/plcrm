<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Module::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = ['edicion', 'renderizado', 'design', 'efectos'];
        return [
            'id_courses' => 21,
            'name' => $name[array_rand($name)],
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $int= mt_Rand(1200000000,1262055681);
        $fecha = date("Y-m-d H:i:s",$int);
        return [
            'transmitter_id' => $this->faker->numberBetween(1,9),
            'receiver_id' =>  $this->faker->numberBetween(1,9),
            'message' => $this->faker->sentence(10),
            'created_at' => $fecha,
            'updated_at' => $fecha
        ];
    }
}

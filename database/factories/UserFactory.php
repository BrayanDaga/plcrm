<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
     
     static $password;
     return [
        'username' => $this->faker->unique()->username(),
        'password' => $password ?: $password = bcrypt('admin'),
        'email' => $this->faker->unique()->email(),
        'name' => $this->faker->name(),
        'last_name' => $this->faker->lastName(),
        'date_birth' => '1990-05-01',
        'phone' => $this->faker->unique()->tollFreePhoneNumber(),
        'id_country' => rand(1, 50),
        'id_document_type' => rand(1, 4),
        'nro_document' => $this->faker->unique()->bankAccountNumber(),
        'id_account_type' => rand(1, 4),
        'request' => 1,
        'id_referrer_sponsor' => 0,
        'position' => "0"
     ];
    }
}

<?php


namespace Database\Factories;


use App\Models\User;
use App\Models\UserMembreship;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserMembreshipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserMembreship::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $password;
        return [
            'user' => $this->faker->unique()->word,
            'password' => $password ?: $password = bcrypt('secret'),
            'name' => $this->faker->name,
            'last_name' => $this->faker->lastName,
            'phone' => '987654321',
            'date_birth' => now(),
            'email' => $this->faker->email,
            'referrer_sponsor' => $this->faker->firstName,
            'id_country' => rand(1, 50),
            'id_document_type' => rand(1, 4),
            'nro_document' => '1111111111',
            'id_account_type' => rand(1, 5),
        ];
    }
}
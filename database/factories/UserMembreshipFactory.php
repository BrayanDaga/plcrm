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
        return [
            'id_document_type' => 10,
            'name' => $this->faker->name,
            'last_name' => $this->faker->lastName,
            'date_birth' => now(),
            'phone' => '987654321',
            'country' => 15,
            'email' => $this->faker->email,
            'user' => $this->faker->unique()->word,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'referrer_sponsor' => $this->faker->firstName,
            'id_account_type' => 10,
        ];
    }
}
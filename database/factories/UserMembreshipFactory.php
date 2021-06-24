<?php


namespace Database\Factories;


use App\Models\User;
use App\Models\UserMembreship;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;
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

        /**
         * Se esta cambiando el nombre de la columna "id_referrer_sponsor" con un solo valor.
         * los metodos "rand" se cambian los valores
         */
        return [
            'user' => $this->faker->unique()->word,
            'password' => $password ?: $password = bcrypt('secret'),
            'name' => $this->faker->name,
            'last_name' => $this->faker->lastName,
            'phone' => '987654321',
            'date_birth' => now(),
            'email' => $this->faker->email,
            'id_referrer_sponsor' => 1,
            'id_country' => rand(1, 50),
            'id_document_type' => rand(1, 4),
            'nro_document' => '1111111111',
            'id_account_type' => rand(1, 4),
        ];
    }
}
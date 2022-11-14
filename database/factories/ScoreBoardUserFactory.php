<?php

namespace Database\Factories;

use App\Models\ScoreBoardUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScoreBoardUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ScoreBoardUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'    => $this->faker->name(),
            'age'     => rand(18, 35),
            'points'  => rand(0, 30),
            'address' => $this->faker->address(),
        ];
    }
}

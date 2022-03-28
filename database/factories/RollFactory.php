<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class RollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'user_id' => User::all()->random()->id,
            //'user_id' => rand(1,10),
            'value1' => rand(1,6),
            'value2' => rand(1,6),
        ];
    }
}

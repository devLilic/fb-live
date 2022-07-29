<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FbUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'=>$this->faker->randomDigit(),
            'fb_user_name' => $this->faker->word(),
            'user_access_token' => $this->faker->word()
        ];
    }
}

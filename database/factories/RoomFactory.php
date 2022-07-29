<?php

namespace Database\Factories;

use App\Models\FbPage;
use App\Models\FbUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'user_id' => User::factory()->create()->id,
            'fb_user_id' => FbUser::factory()->create()->id,
            'fb_page_id' =>FbPage::factory()->create()->id
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FbPageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => '100359165005197',
            'page_title' => 'DevTest',
            'page_img_link' => 'https://graph.facebook.com/100359165005197/picture?type=large'
        ];
    }
}

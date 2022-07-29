<?php

namespace Database\Factories;

use App\Models\FbPage;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $page = FbPage::where('id', '100359165005197')->first();
        if(!$page){
            $page = FbPage::factory()->create();
        }
        $title = $this->faker->word();
        return [
            'title' => $title,
            'live_title' => $title,
            'start_time' => '18:00',
            'duration' => '52',
            'days' => '1234567',
            'fb_page_id' => $page
        ];
    }
}

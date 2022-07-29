<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::factory()->create([
            'title' => 'Telejurnal 13.00',
            'live_title' => 'Telejurnal 13.00',
            'start_time' => '13:00',
            'days' => '12345',
            'duration' => '25'
        ]);
        Schedule::factory()->create([
            'title' => 'Obiectiv Comun',
            'live_title' => 'Obiectiv Comun',
            'start_time' => '17:00',
            'days' => '12345'
        ]);
        Schedule::factory()->create([
            'title' => 'Telejurnal 18.00',
            'live_title' => 'Telejurnal 18.00'
        ]);
        Schedule::factory()->create([
            'title' => 'Punctul pe Azi',
            'live_title' => 'Punctul pe Azi',
            'start_time' => '19:00',
            'days' => '12345'
        ]);
        Schedule::factory()->create([
            'title' => 'Traditii',
            'live_title' => 'Traditii',
            'start_time' => '13:00',
            'days' => '6',
            'duration' => '58'
        ]);
        Schedule::factory()->create([
            'title' => 'Retrospectiva saptamanii',
            'live_title' => 'Retrospectiva saptamanii',
            'start_time' => '14:30',
            'days' => '7',
            'duration' => '30'
        ]);
        Schedule::factory()->create([
            'title' => 'Conexiuni',
            'live_title' => 'Conexiuni',
            'start_time' => '19:00',
            'days' => '7',
            'duration' => '55'
        ]);
        Schedule::factory()->create([
            'title' => 'Sinteza zilei',
            'live_title' => 'Sinteza zilei',
            'start_time' => '22:00',
            'days' => '12345',
            'duration' => '10'
        ]);
        Schedule::factory()->create([
            'title' => 'Telematinal',
            'live_title' => 'Telematinal',
            'start_time' => '07:00',
            'days' => '12345',
            'duration' => '165'
        ]);
        Schedule::factory()->create([
            'title' => 'Lectia de istorie',
            'live_title' => 'Lectia de istorie',
            'start_time' => '19:00',
            'days' => '6',
        ]);
        Schedule::factory()->create([
            'title' => 'Testing Live',
            'live_title' => 'Testing Live',
            'start_time' => '15:00',
            'days' => '1234567',
            'duration' => '5'
        ]);
    }
}

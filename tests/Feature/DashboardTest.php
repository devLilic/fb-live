<?php

namespace Tests\Feature;

use App\Http\Livewire\Dashboard;
use App\Models\FbPage;
use App\Models\FbUser;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_list_of_today_schedules()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $schedule = Schedule::factory()->create();
        $response = Livewire::test(Dashboard::class)
            ->set('clientTime', '12:00')
            ->call('updateList');

    }
}

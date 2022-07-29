<?php

namespace Tests\Feature\Live;

//use Facades\App\Services\Live\QuickLive;
use App\Services\Live\QuickLive;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuickLiveTest extends TestCase
{
    /** @test */
    public function has_a_title()
    {
        $live1 = new QuickLive('title 1');
        $this->assertEquals('title 1', $live1->getTitle());
    }

}

<?php

namespace Tests\Feature;

use App\Models\FbPage;
use App\Models\FbUser;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomTest extends TestCase {

    use RefreshDatabase;

    private $owner;
    private $room;

    public function setUp(): void
    {
        parent::setUp();
        $this->owner = User::factory()->create();
        $this->room = Room::factory()->create(['user_id' => $this->owner->id]);
    }

    /** @test */
    public function user_can_create_a_room()
    {
        $this->actingAs($this->owner);

        $arr = [
            'id' => 1,
            'title' => 'room 1',
            'fb_page_id' => FbPage::factory()->create(['id'=>1])->id,
            'fb_user_id' => FbUser::factory()->create()->id,
            'user_id' => $this->owner->id
        ];
        $this->post('/rooms', $arr);

        $this->assertDatabaseHas('rooms', ['title' => 'room 1']);
    }

    /** @test */
    public function room_has_a_owner()
    {
        $this->assertEquals($this->user->name, $this->room->owner->name);
    }

    /** @test */
    public function owner_can_visit_room_page()
    {
        $room = Room::factory()->create();

        $this->actingAs($room->owner);

        $this->get('rooms')->assertSee($room->title);
    }

    /** @test */
    public function cannot_see_other_users_rooms()
    {
        $room = Room::factory()->create();
        $not_owner = User::factory()->create();
        $this->actingAs($not_owner);

        $this->get('rooms')->assertDontSee($room->title);
    }

    /** @test */
    public function owner_can_visit_his_room()
    {
        $room = Room::factory()->create();
        $this->actingAs($room->owner);

        $this->get('rooms/' . $room->id)
            ->assertSee($room->title)
            ->assertSee('Owner: ' . $room->owner->name);
    }

    /** @test */
    public function cannot_see_other_user_room()
    {
        $room = Room::factory()->create();
        $other_user = User::factory()->create();
        $this->actingAs($other_user);

        $this->get('rooms/' . $room->id)->assertForbidden();
    }

    /** @test */
    public function owner_can_invite_other_user_in_his_room()
    {
        $guest = User::factory()->create();
        $room = Room::factory()->create();
        $this->actingAs($room->owner);
        $this->post('/room/' . $room->id . '/members', ['user_id' => $guest->id]);
        $room->owner->invite($guest, $room);
        $this->assertDatabaseHas('rooms_users', ['user_id' => $guest->id, 'room_id' => $room->id]);
    }
}

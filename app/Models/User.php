<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'fb_user_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function fbUser(){
        return $this->belongsTo(FbUser::class, 'fb_user_id', 'id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function invite(User $user, Room $room)
    {
        DB::table('rooms_users')->insert([
            'user_id' => $user->id,
            'room_id' => $room->id
        ]);
    }

    public function settings(){
        return $this->hasMany(UserSetting::class);
    }
}

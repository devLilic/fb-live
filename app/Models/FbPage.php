<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FbPage extends Model {

    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'page_title',
        'page_img_link'
    ];

    public function fbUsers()
    {
        return $this->belongsToMany(FbUser::class, 'fb_pages_fb_users', 'fb_page_id', 'fb_user_id')
            ->withPivot('page_access_token');
    }

    public function fbLives(){
        return $this->hasMany(FbLive::class, 'page_id');
    }

    public function schedules(){
        return $this->hasMany(Schedule::class);
    }
}

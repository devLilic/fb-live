<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FbUser extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'fb_user_name', 'user_access_token'];

    public function fbPages(){
        return $this->belongsToMany(FbPage::class, 'fb_pages_fb_users', 'fb_user_id', 'fb_page_id')
            ->withPivot('page_access_token');
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}

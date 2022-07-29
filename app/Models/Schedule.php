<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Schedule extends Model
{
    public $fillable = ['title', 'live_title', 'start_time', 'duration', 'days', 'fb_page_id', 'disabled'];
    use HasFactory;

    public function fbPage(){
        return $this->belongsTo(FbPage::class);
    }

    public function getTodayList()
    {

    }

}

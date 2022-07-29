<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logger extends Model
{
    use HasFactory;

    protected $fillable = [ 'fb_page_id', 'user_id', 'message', 'shown'];


    public function fbPage()
    {
        return $this->belongsTo(FbPage::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeSeen($query){
        return $query->where('shown', FALSE);
    }

    public function log($message, FbPage $page){
        $this->attributes = [
            'fb_page_id' => $page->id,
            'user_id' => auth()->user()->id,
            'message' => $message
        ];
        $this->save();
    }

}

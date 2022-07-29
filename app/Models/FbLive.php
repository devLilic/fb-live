<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FbLive extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'stream_key',
        'embed_url',
        'page_id',
        'title',
        'description'
    ];

    public function fbPage(){
        return $this->belongsTo(FbPage::class, 'page_id', 'id');
    }
}

<?php

namespace App\Services\Live;

use App\Models\FbLive;
use Illuminate\Support\Str;

abstract class AbstractLive implements LiveInterface {

    /**
     * @var null
     */
    protected $streamKey;
    protected $page;
    protected $live_data;
    protected $info;
    protected $title;

    public function __construct($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

//    protected function save(){
//        return FbLive::create([
//            'id' => $live['id'],
//            'embed_url' => $this->formatPreviewUrl($live['embed_html']),
//            'title' => $this->title,
//            'stream_key' => $this->setStreamKey(),
//            'page_id' => $this->getPage()->id
//        ]);
//    }
//
//    protected function formatPreviewUrl($html)
//    {
//        $url = Str::of($html)->explode(" ")->filter(function ($item)
//        {
//            return Str::of($item)->contains('src=');
//        })->first();
//
//        return substr($url, 5, -1);
//    }
//
//    protected function setStreamKey()
//    {
//        return Str::of($this->info['ingest_streams'][0]['secure_stream_url'])
//            ->explode('/')
//            ->pop();
//    }
//
//    protected function getParams($title, $status='LIVE_NOW'){
//        return [
//            'title' => $title,
//            'description' => $title,
//            'status' => $status
//        ];
//    }
//
//    protected function getLiveObject(){
//        $params = $this->getParams($this->title);
//        return $this->fbApi
//            ->live($this->page->id, $params, $this->access_token)
//            ->getDecodedBody();
//    }
//
//    protected function getLiveInfo($liveObjectId){
//        return $this->fbApi
//            ->get('live-video-info', $this->access_token, $liveObjectId)
//            ->getDecodedBody();
//    }
}

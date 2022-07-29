<?php

namespace App\Services;

use App\Models\FbLive;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Facades\App\Services\FbApi;

class Live {

    private $page;
    private $access_token;

    private $title;
    private $info;

    public function __construct()
    {
        $this->page = $this->getPage();
        $this->access_token = $this->getAccessToken();
    }

    public function create($title = '', $published = TRUE)
    {
        $this->title = $title;

        $params['title'] = $title;
        $params['description'] = $title;
        $params['status'] = $published ? 'LIVE_NOW' : "UNPUBLISHED";
        try {
            $liveObject = FbApi::live($this->page->id, $params, $this->access_token)
                ->getDecodedBody();

            $this->info = $this->getInfo($liveObject['id']);

            return $this->save($this->info);

        } catch (\Exception $e) {
            return Log::error($e);
        }
    }

    public function get()
    {
        return $this->page->fbLives->last();
    }

    public function end()
    {
//        dd($this->get()->id, $this->access_token);
        FbApi::stop_live($this->get()->id, $this->access_token);
    }

    public function getPage()
    {
        return auth()->user()->fbUser->fbPages->first();
    }

    public function getAccessToken()
    {
        return $this->page->pivot->page_access_token;
    }

    protected function save($live)
    {
        return FbLive::create([
            'id' => $live['id'],
            'embed_url' => $this->formatPreviewUrl($live['embed_html']),
            'title' => $this->title,
            'stream_key' => $this->setStreamKey(),
            'page_id' => $this->getPage()->id
        ]);
    }

    public function getStreamKey()
    {
        return $this->info->stream_key;
    }

    protected function setStreamKey()
    {
        return Str::of($this->info['ingest_streams'][0]['secure_stream_url'])
            ->explode('/')
            ->pop();
    }

    protected function formatPreviewUrl($html)
    {
        $url = Str::of($html)->explode(" ")->filter(function ($item)
        {
            return Str::of($item)->contains('src=');
        })->first();

        return substr($url, 5, -1);
    }

    public function activate()
    {
        $live = $this->get();
        FbApi::goLive($live['id'], $this->getAccessToken());
    }

    public function previewReady($live)
    {
        $response = $this->getInfo($live['id']);

        return $this->hasVideo($response);
    }

    public function getPreview()
    {
        $live = $this->get();
        $request_in_progress = TRUE;
        while ($request_in_progress) {
            $response = $this->getInfo($live['id']);
            sleep(2);

            if ($this->hasVideo($response) && $this->isStatusLive($response)) {
                sleep(2);

                $request_in_progress = FALSE;
            }
        }

        return $live->embed_url;
    }

    protected function hasVideo($response)
    {
        return array_key_exists('stream_health', $response['ingest_streams'][0]);
    }

    protected function isStatusLive($response)
    {
        return $response['status'] == "LIVE";
    }

    /**
     * @param $liveID
     * @return mixed
     */
    protected function getInfo($liveID)
    {
        return FbApi::get('live-video-info', $this->getAccessToken(), $liveID)
            ->getDecodedBody();
    }
}

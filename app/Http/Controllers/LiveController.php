<?php

namespace App\Http\Controllers;

use App\Http\Requests\StartLiveFormRequest;
use App\Models\FbLive;
use App\Services\FbApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class LiveController extends Controller {

    public function start(StartLiveFormRequest $request, FbApi $fbApi)
    {
        $params = $request->validated();

        $page = auth()->user()->fbUser->fbPages;
        $access_token = $page[0]->pivot->page_access_token;

        $liveObject = $fbApi->live($page[0]->id, $params, $access_token)->getDecodedBody();
        dd($liveObject);
        $liveInfo = $fbApi->get('live-video-info', $access_token, $liveObject['id'])->getDecodedBody();
        dd($liveInfo);
//        $key = Str::of($liveInfo['ingest_streams'][0]['secure_stream_url'])->explode('/')->pop();
        FbLive::create([
            'id' => $liveInfo['id'],
            'embed_url' => Str::between($liveInfo['embed_html'], 'src="', '"'),
            'title' => $params['title'],
            'stream_key' => Str::of($liveInfo['ingest_streams'][0]['secure_stream_url'])->explode('/')->pop(),
            'page_id' => $page[0]->id
        ]);
        Cache::put('live_id', $liveInfo['id']);

        return redirect()->route('dashboard');
    }

    public function stop(FbApi $fbApi){
        $video = FbLive::find(Cache::get('live_id'));
        Cache::forget('live_id');
        $page = auth()->user()->fbUser->fbPages;
        $access_token = $page[0]->pivot->page_access_token;
        $fbApi->stop_live($video->id, $access_token);
        return redirect()->route('dashboard');
    }
}

<?php

namespace App\Services;

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;

class FbApi {

    protected $facebook;

    public function __construct()
    {
        $this->facebook = new Facebook([
            'app_id' => config('providers.facebook.app_id'),
            'app_secret' => config('providers.facebook.app_secret'),
            'default_graph_version' => 'v11.0'
        ]);
    }

    public function loginStatus()
    {
        return $this->facebook->getRedirectLoginHelper()->getPersistentDataHandler()->get('state');
    }

    public function getLogoutLink($authToken, $route)
    {
        $helper = $this->facebook->getRedirectLoginHelper();
        return $helper->getLogoutUrl($authToken, $route);
    }

    public function redirectTo()
    {
        $helper = $this->facebook->getRedirectLoginHelper();

        $permissions = config('providers.facebook.permissions');

        $redirectUri = config('app.url') . '/auth/facebook/callback';

        return $helper->getLoginUrl($redirectUri, $permissions);
    }

    public function handleCallback()
    {
        $helper = $this->facebook->getRedirectLoginHelper();

        if (request('state')) {
            $helper->getPersistentDataHandler()->set('state', request('state'));
        }

        try {
            $accessToken = $helper->getAccessToken();
        } catch(FacebookResponseException $e) {
            throw new \Exception("Graph returned an error: {$e->getMessage()}");
        } catch(FacebookSDKException $e) {
            throw new \Exception("Facebook SDK returned an error: {$e->getMessage()}");
        }

        if (!isset($accessToken)) {
            throw new \Exception('Access token error');
        }

        if (!$accessToken->isLongLived()) {
            try {
                $oAuth2Client = $this->facebook->getOAuth2Client();
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (FacebookSDKException $e) {
                throw new \Exception("Error getting a long-lived access token: {$e->getMessage()}");
            }
        }

        return $accessToken->getValue();

        //store access token in database and use it to get pages
    }
    public function getPages($accessToken)
    {
        $pages = $this->facebook->get('/me/accounts', $accessToken);
        $pages = $pages->getGraphEdge()->asArray();

        return array_map(function ($item) {
            return [
                'access_token' => $item['access_token'],
                'id' => $item['id'],
                'name' => $item['name'],
                'image' => "https://graph.facebook.com/{$item['id']}/picture?type=large"
            ];
        }, $pages);
    }

    public function get($endpoint, $accessToken, $instanceId=null){
        $routes = [
            'me' => '/me',
            'live-video-info' => "$instanceId?fields=ingest_streams,embed_html,from,title,description,status"
        ];
        try {
            $response = $this->facebook->get(
                $routes[$endpoint],
                $accessToken
            );
            return $response;
        } catch (FacebookResponseException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        } catch (FacebookSDKException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public function post($accountId, $accessToken, $content)
    {
        $data = ['message' => $content];

        try {
            $response = $this->facebook->post(
                "$accountId/feed",
                $data,
                $accessToken
            );
            return $response->getGraphNode();

        } catch (FacebookResponseException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        } catch (FacebookSDKException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public function goLive($liveId, $accessToken){
        $data = ['status' => 'LIVE_NOW'];
        try {
            $response = $this->facebook->post(
                "$liveId",
                $data,
                $accessToken
            );
            return $response;
        } catch (FacebookResponseException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        } catch (FacebookSDKException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public function live($pageId, $data, $accessToken){
        try {
            $response = $this->facebook->post(
                "$pageId/live_videos",
                $data,
                $accessToken
            );
            return $response;
        } catch (FacebookResponseException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        } catch (FacebookSDKException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public function stop_live($live_video_id, $accessToken){
        try {
            $data = [
                'end_live_video' => true
            ];
            $response = $this->facebook->post(
                "$live_video_id",
                $data,
                $accessToken
            );
            return $response;
        } catch (FacebookResponseException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        } catch (FacebookSDKException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}

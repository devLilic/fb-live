<?php

namespace App\Services;

class Page {

    private static $instance;

    private static $page;
    private $access_token;
    private $fbApi;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __construct()
    {
        self::$page = auth()->user()->fbUser->fbPage[0];
        $this->access_token = $this->getAccessToken();
        $this->fbApi = new FbApi();
    }

    public static function get(){
        return auth()->user()->fbUser->fbPage[0];
    }

    public function getAccessToken()
    {
        return $this->page->pivot->page_access_token;
    }
}

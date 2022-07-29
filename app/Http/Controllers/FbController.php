<?php

namespace App\Http\Controllers;

use App\Services\FbApi;

class FbController extends Controller {

    public function index()
    {
        $fbApi = new FbApi();
        $data = [];
        if (session('data')){
            $data = session('data');
            $data['logout'] = $fbApi->getLogoutLink($data['token'], route('fb-index'));
        }

        return view('pages.fb.index', [
            'data' => $data,
            'loginUrl' => $fbApi->redirectTo(),
        ]);
    }

    public function callback()
    {
        $data = [];
        $fbApi = new FbApi();
        $data['token'] = $fbApi->handleCallback();
        $data['user'] = $fbApi->get('me', $data['token'])->getDecodedBody();
        $data['pages'] = $fbApi->getPages($data['token']);
        return redirect('fbtest')->with('data', $data);
    }

    public function logout()
    {
        return redirect('fbtest');
    }
}

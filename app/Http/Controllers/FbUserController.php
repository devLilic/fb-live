<?php

namespace App\Http\Controllers;

use App\Models\FbPage;
use App\Models\FbUser;
use App\Models\User;
use App\Services\FbApi;

class FbUserController extends Controller {

    public function index(FbApi $fbApi)
    {
        $userAuthToken = $fbApi->handleCallback();
        $user = $fbApi->get('me', $userAuthToken);
        $userData = $user->getDecodedBody();
        $fbUser = FbUser::firstOrCreate(
            ['id' => $userData['id']],
            [
                'fb_user_name' => $userData['name'],
                'user_access_token' => $userAuthToken
            ]);
        User::where('id', auth()->id())
            ->update(['fb_user_id' => $fbUser->id]);
        $pages = $fbApi->getPages($userAuthToken);

        foreach ($pages as $page) {
            $item = FbPage::firstOrCreate(
                ['id' => $page['id']],
                [
                    'page_title' => $page['name'],
                    'page_img_link' => $page['image']
                ]);
            $fbUser->fbPages()->attach($item, [
                'page_access_token' => $page['access_token']
            ]);
        }

        return redirect()->route('dashboard', compact('fbUser'));
    }
}

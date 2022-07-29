<?php
return [
    'facebook' => [
        'app_id' => env('FACEBOOK_APP_ID'),
        'app_secret' => env('FACEBOOK_APP_SECRET'),
        'permissions' => [
            'pages_manage_posts',
            'pages_read_engagement',
            'publish_video',
            'public_profile'
        ]
    ],
];

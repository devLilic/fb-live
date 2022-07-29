<x-app-layout>
    <x-main-content>
        @if($data)
            <div>
                {{ $data['token'] }}

                <div>
                    User:
                    {{ $data['user']['name']  }}
                </div>
                <div>
                    Page:
                    {{ $data['pages'][0]['name'] }}
                    <br>
                    {{ $data['pages'][0]['access_token'] }}
                </div>
            </div>
            <br>
            <a href="{{ $data['logout'] }}">Logout</a>
        @else
            <a href="{{$loginUrl}}">Login: {{ $loginUrl }}</a>
        @endif

        {{--        <div class = "container">--}}

        {{--            <div class = "hero-unit">--}}
        {{--                <h1>Hello <?php echo $_SESSION['USERNAME']; ?></h1>--}}
        {{--                <p>Welcome to "facebook login" tutorial</p>--}}
        {{--            </div>--}}

        {{--            <div class = "span4">--}}

        {{--                <ul class = "nav nav-list">--}}
        {{--                    <li class = "nav-header">Image</li>--}}

        {{--                    <li><img src = "https://graph.facebook.com/<?php--}}
        {{--                     echo $_SESSION['FBID']; ?>/picture"></li>--}}

        {{--                    <li class = "nav-header">Facebook ID</li>--}}
        {{--                    <li><?php echo  $_SESSION['FBID']; ?></li>--}}

        {{--                    <li class = "nav-header">Facebook fullname</li>--}}

        {{--                    <li><?php echo $_SESSION['FULLNAME']; ?></li>--}}

        {{--                    <li class = "nav-header">Facebook Email</li>--}}

        {{--                    <li><?php echo $_SESSION['EMAIL']; ?></li>--}}

        {{--                    <div><a href="logout.php">Logout</a></div>--}}

        {{--                </ul>--}}

        {{--            </div>--}}
        {{--        </div>--}}

        {{--        <?php else: ?>     <!-- Before login -->--}}

        {{--        <div class = "container">--}}
        {{--            <h1>Login with Facebook</h1>--}}
        {{--            Not Connected--}}

        {{--            <div>--}}
        {{--                <a href = "fbconfig.php">Login with Facebook</a>--}}
        {{--            </div>--}}

        {{--            <div>--}}
        {{--                <a href = "http://www.tutorialspoint.com"--}}
        {{--                   title = "Login with facebook">More information about Tutorialspoint</a>--}}
        {{--            </div>--}}
        {{--        </div>--}}


    </x-main-content>
</x-app-layout>

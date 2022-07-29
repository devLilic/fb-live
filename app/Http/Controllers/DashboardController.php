<?php

namespace App\Http\Controllers;

use App\Models\FbLive;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class DashboardController extends Controller {

    public function index()
    {
        return view('pages.dashboard');
    }

    public function program()
    {
        return view('program');
    }
}

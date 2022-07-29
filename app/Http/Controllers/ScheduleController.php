<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateScheduleRequest;
use App\Models\FbPage;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $pages = auth()->user()->fbUser->fbPages;
        foreach ($pages as $page){
            $pagesSchedules = Schedule::where('fb_page_id', $page->id)->get();
        }
        return view('schedules.index', [
                'pagesSchedules' => $pagesSchedules,
                'pages' => $pages
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $pages = auth()->user()->fbUser->fbPages;
        return view('schedules.create', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateScheduleRequest $request)
    {
        $data = $request->validated();
        Schedule::create([
            'title' => $data['title'],
            'live_title' => $data['title'],
            'start_time' => $data['time'],
            'duration' => $data['duration'],
            'days' => implode($data['days']),
            'fb_page_id' => $data['page'],
            'disabled' => isset($data['disabled'])
        ]);
        return redirect()->route('schedule.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $pages = auth()->user()->fbUser->fbPages;
        return view('schedules.edit', [
            'pages'=> $pages,
            'schedule'=> $schedule
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateScheduleRequest $request
     * @param Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(CreateScheduleRequest $request, Schedule $schedule)
    {
        $data = $request->validated();
//        dd($data);
        $schedule->update([
            'title' => $data['title'],
            'live_title' => $data['title'],
            'start_time' => $data['time'],
            'duration' => $data['duration'],
            'days' => implode($data['days']),
            'fb_page_id' => $data['page'],
            'disabled' => isset($data['disabled'])
        ]);
        return redirect()->route('schedule.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Schedule $schedule
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Schedule $schedule): \Illuminate\Http\RedirectResponse
    {
        $schedule->delete();
        return redirect()->route('schedule.index');
    }
}

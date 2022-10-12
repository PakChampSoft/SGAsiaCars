<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pageTitle = 'User Activities';
        $from = Carbon::parse(request()->from)->toDateString();
        $to = Carbon::parse(request()->to)->toDateString();
        $query = UserActivity::latest();

        if(request()->filled('from')){
            $query->whereDate('created_at', '>=', $from);
        }

        if(request()->filled('to')){
            $query->whereDate('created_at', '<=', $to);
        }

        $userActivities = $query->paginate(50);

        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'UserActivity', 'UserActivity Index');

        return view('admin.activity.index', compact('userActivities', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserActivity  $userActivity
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pageTitle = $id . ' Activities';
        $from = Carbon::parse(request()->from)->toDateString();
        $to = Carbon::parse(request()->to)->toDateString();
        $query = UserActivity::where('user_id', $id)->latest();

        if(request()->filled('from')){
            $query->whereDate('created_at', '>=', $from);
        }

        if(request()->filled('to')){
            $query->whereDate('created_at', '<=', $to);
        }

        $userActivities = $query->paginate(50);

        $this->logActivity(auth()->id(), request()->ip(), 'Show', 'UserActivity', 'UserActivity Show');
        // $userActivities = UserActivity::where('user_id', $id)->paginate(20);
        return view('admin.activity.show', compact('userActivities', 'pageTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserActivity  $userActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(UserActivity $userActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserActivity  $userActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserActivity $userActivity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserActivity  $userActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserActivity $userActivity)
    {
        //
    }


    public function downloadReport($id)
    {
        $user = User::with('activities')->findOrFail($id);

        $from = Carbon::parse(request()->from)->toDateString();
        $to = Carbon::parse(request()->to)->toDateString();
        $query = UserActivity::where('user_id', $id)->latest();

        if(request()->filled('from')){
            $query->whereDate('created_at', '>=', $from);
        }

        if(request()->filled('to')){
            $query->whereDate('created_at', '<=', $to);
        }

        $userActivities = $query->get();

        $pdf = \PDF::loadView('admin.pdf.user-activity-pdf', ['user' => $user, 'userActivities' => $userActivities, 'from' => $from, 'to' => $to]);

        $this->logActivity(auth()->id(), request()->ip(), 'Download', 'UserActivity', 'UserActivity Download');

        return $pdf->download($user->id . '-' . now() . '.pdf');
    }
}

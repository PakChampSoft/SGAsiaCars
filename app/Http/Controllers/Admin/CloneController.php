<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteClone;
use Illuminate\Http\Request;

class CloneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Clones';

        $clones = SiteClone::paginate(10);

        return view('admin.clone.index', compact('clones', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create Clone';

        return view('admin.clone.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'company_name' => 'required',
            'email' => 'required',
            'admin_username' => 'required',
            'admin_password' => 'required',
            'admin_url' => 'required',
            'domain' => 'required',
            'country' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'status' => 'required',
        ]);

        $clone = SiteClone::create([
            'name' => $request->name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'admin_username' => $request->admin_username,
            'admin_password' => $request->admin_password,
            'admin_url' => $request->admin_url,
            'domain' => $request->domain,
            'country' => $request->country,
            'city' => $request->city,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
        ]);

        toastr()->success('Clone Created Successfully');

        return redirect()->route('clones.index');

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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clone = SiteClone::findOrFail($id);

        $clone->delete();

        toastr()->success('Clone Deleted Successfully');

        return redirect()->back();
    }
}

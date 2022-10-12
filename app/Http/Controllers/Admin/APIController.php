<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\APIClient;
use Illuminate\Http\Request;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Outsource API Clients';

        $clients = APIClient::all();

        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'APIClient', 'APIClient Index');

        return view('admin.api-client.index', compact('clients', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create API Client';

        $this->logActivity(auth()->id(), request()->ip(), 'Create', 'APIClient', 'APIClient Create');

        return view('admin.api-client.create', compact('pageTitle'));
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
            'client_name' => 'required',
            'access_id' => 'required',
            'access_key' => 'required',
            'status' => 'required',
        ]);

        $client = APIClient::create([
            'client_name' => $request->client_name,
            'access_id' => $request->access_id,
            'access_key' => $request->access_key,
            'status' => $request->status,
        ]);

        $this->logActivity(auth()->id(), request()->ip(), 'Store', 'APIClient', 'APIClient Store');

        toastr()->success('API Client Created Successfully');

        return redirect()->route('api-clients.index');
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

    public function toggleStatus($id)
    {
        $client = APIClient::findOrFail($id);

        $client->status = !$client->status;

        $client->save();

        $this->logActivity(auth()->id(), request()->ip(), 'ToggleStatus', 'APIClient', 'APIClient ToggleStatus');

        toastr()->success('API Client Status Changed Successfully');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

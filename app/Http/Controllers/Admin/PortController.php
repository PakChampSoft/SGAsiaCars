<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Port;
use Illuminate\Http\Request;

class PortController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Ports';

        $ports = Port::with('country')->paginate(10);

        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'Port', 'Port Index');

        return view('admin.port.index', compact('ports', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create Port';

        $countries = Country::all();

        $this->logActivity(auth()->id(), request()->ip(), 'Create', 'Port', 'Port Create');

        return view('admin.port.create', compact('countries', 'pageTitle'));
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
            'country' => 'required',
            'name' => 'required',
            'insurance' => 'required',
            'inspection' => 'required',
            'certificate' => 'required',
            'warranty' => 'required',
            'amount' => 'required',
        ]);

        $port = Port::create([
            'country_id' => $request->country,
            'name' => $request->name,
            'insurance' => $request->insurance,
            'inspection' => $request->inspection,
            'certificate' => $request->certificate,
            'warranty' => $request->warranty,
            'amount' => $request->amount,
        ]);

        $this->logActivity(auth()->id(), request()->ip(), 'Store', 'Port', 'Port Store');

        toastr()->success('Port Created Successfully');

        return redirect()->route('ports.index');
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
        $pageTitle = 'Edit Port';

        $port = Port::with('country')->findOrFail($id);

        $countries = Country::all();

        $this->logActivity(auth()->id(), request()->ip(), 'Edit', 'Port', 'Port Edit');

        return view('admin.port.edit', compact('port', 'countries', 'pageTitle'));
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
        $port = Port::findOrFail($id);
        $request->validate([
            'country' => 'required',
            'name' => 'required',
            'insurance' => 'required',
            'inspection' => 'required',
            'certificate' => 'required',
            'warranty' => 'required',
            'amount' => 'required',
        ]);

        $port->update([
            'country_id' => $request->country,
            'name' => $request->name,
            'insurance' => $request->insurance,
            'inspection' => $request->inspection,
            'certificate' => $request->certificate,
            'warranty' => $request->warranty,
            'amount' => $request->amount,
        ]);

        $this->logActivity(auth()->id(), request()->ip(), 'Update', 'Port', 'Port Update');

        toastr()->success('Port Updated Successfully');

        return redirect()->route('ports.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $port = Port::findOrFail($id);

        $port->delete();

        $this->logActivity(auth()->id(), request()->ip(), 'Destroy', 'Port', 'Port Destroy');

        toastr()->success('Port Deleted Successfully');

        return redirect()->back();
    }
}

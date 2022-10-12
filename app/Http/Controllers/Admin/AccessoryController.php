<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accessory;
use Illuminate\Http\Request;

class AccessoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Accessories';

        $accessories = Accessory::paginate(10);

        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'Accessory', 'Accessory Index');

        return view('admin.accessory.index', compact('accessories', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create Accessory';

        $this->logActivity(auth()->id(), request()->ip(), 'Create', 'Accessory', 'Accessory Create');

        return view('admin.accessory.create', compact('pageTitle'));
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
            'name' => 'required'
        ]);

        $accessory = Accessory::create([
            'name' => $request->name,
            'status' => 1
        ]);

        $this->logActivity(auth()->id(), request()->ip(), 'Store', 'Accessory', 'Accessory Store');

        toastr()->success('Accessory Created Successfully');

        return redirect()->route('accessories.index');
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
        $pageTitle = 'Edit Accessory';

        $accessory = Accessory::findOrFail($id);

        $this->logActivity(auth()->id(), request()->ip(), 'Edit', 'Accessory', 'Accessory Edit');

        return view('admin.accessory.edit', compact('pageTitle', 'accessory'));
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
        $accessory = Accessory::findOrFail($id);

        $request->validate([
            'name' => 'required'
        ]);

        $accessory->update([
            'name' => $request->name
        ]);

        $this->logActivity(auth()->id(), request()->ip(), 'Update', 'Accessory', 'Accessory Update');

        toastr()->success('Accessory Updated Successfully');

        return redirect()->route('accessories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accessory = Accessory::findOrFail($id);

        $accessory->delete();

        $this->logActivity(auth()->id(), request()->ip(), 'Destroy', 'Accessory', 'Accessory Destroy');

        toastr()->success('Accessory Deleted Successfully');

        return redirect()->back();
    }
}

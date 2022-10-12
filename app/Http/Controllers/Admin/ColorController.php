<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Color';

        $colors = Color::paginate(10);

        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'Color', 'Color Index');

        return view('admin.color.index', compact('colors', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create Color';

        $this->logActivity(auth()->id(), request()->ip(), 'Create', 'Color', 'Color Create');

        return view('admin.color.create', compact('pageTitle'));
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

        $color = Color::create([
            'name' => $request->name,
            'status' => 1
        ]);

        $this->logActivity(auth()->id(), request()->ip(), 'Store', 'Color', 'Color Store');

        toastr()->success('Color Created Successfully');

        return redirect()->route('colors.index');
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
        $pageTitle = 'Edit Color';

        $color = Color::findOrFail($id);

        $this->logActivity(auth()->id(), request()->ip(), 'Edit', 'Color', 'Color Edit');

        return view('admin.color.edit', compact('pageTitle', 'color'));
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
        $color = Color::findOrFail($id);

        $request->validate([
            'name' => 'required'
        ]);

        $color->update([
            'name' => $request->name
        ]);

        $this->logActivity(auth()->id(), request()->ip(), 'Update', 'Color', 'Color Update');

        toastr()->success('Color Updated Successfully');

        return redirect()->route('colors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color = Color::findOrFail($id);

        $color->delete();

        $this->logActivity(auth()->id(), request()->ip(), 'Destroy', 'Color', 'Color Destroy');

        toastr()->success('Color Deleted Successfully');

        return redirect()->back();
    }
}

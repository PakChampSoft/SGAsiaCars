<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Types';

        $types = Type::paginate(10);

        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'Type', 'Type Index');

        return view('admin.type.index', compact('types', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create Type';

        $this->logActivity(auth()->id(), request()->ip(), 'Create', 'Type', 'Type Create');

        return view('admin.type.create', compact('pageTitle'));
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

        $type = Type::create([
            'name' => $request->name,
            'status' => 1
        ]);

        $this->logActivity(auth()->id(), request()->ip(), 'Store', 'Type', 'Type Store');

        toastr()->success('Type Created Successfully');

        return redirect()->route('types.index');
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
        $pageTitle = 'Edit Type';

        $type = Type::findOrFail($id);

        $this->logActivity(auth()->id(), request()->ip(), 'Edit', 'Type', 'Type Edit');

        return view('admin.type.edit', compact('pageTitle', 'type'));
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
        $type = Type::findOrFail($id);

        $request->validate([
            'name' => 'required'
        ]);

        $type->update([
            'name' => $request->name
        ]);

        $this->logActivity(auth()->id(), request()->ip(), 'Update', 'Type', 'Type Update');

        toastr()->success('Type Updated Successfully');

        return redirect()->route('types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Type::findOrFail($id);

        $type->delete();

        $this->logActivity(auth()->id(), request()->ip(), 'Destroy', 'Type', 'Type Destroy');

        toastr()->success('Type Deleted Successfully');

        return redirect()->back();
    }
}

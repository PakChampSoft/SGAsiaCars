<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Permissions';
        $permissions = Permission::all();
        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'Permission', 'Permission Index');
        return view('admin.permission.index', compact('permissions', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create Permission';
        $this->logActivity(auth()->id(), request()->ip(), 'Create', 'Permission', 'Permission Create');
        return view('admin.permission.create', compact('pageTitle'));
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

        $permission = Permission::create([
            'name' => $request->name
        ]);

        $this->logActivity(auth()->id(), request()->ip(), 'Store', 'Permission', 'Permission Store');

        toastr()->success('Permission Added Successfully');

        return redirect()->route('permissions.index');
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
        $pageTitle = 'Edit Permission';
        $permission = Permission::findOrFail($id);

        $this->logActivity(auth()->id(), request()->ip(), 'Edit', 'Permission', 'Permission Edit');

        return view('admin.permission.edit', compact('permission', 'pageTitle'));
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
        $request->validate([
            'name' => 'required'
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update([
            'name' => $request->name
        ]);

        $this->logActivity(auth()->id(), request()->ip(), 'Update', 'Permission', 'Permission Update');

        toastr()->success('Permission Updated Successfully');

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        $this->logActivity(auth()->id(), request()->ip(), 'Destroy', 'Permission', 'Permission Destroy');

        toastr()->success('Permission Deleted Successfully');

        return redirect()->back();
    }
}

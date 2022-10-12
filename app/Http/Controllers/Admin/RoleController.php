<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Roles';
        $roles = Role::all();

        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'Role', 'Role Index');

        return view('admin.role.index', compact('roles', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create Role';
        $permissions = Permission::all();

        $this->logActivity(auth()->id(), request()->ip(), 'Create', 'Role', 'Role Create');

        return view('admin.role.create', compact('permissions', 'pageTitle'));
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
            'permissions' => 'required'
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);

        $role->givePermissionTo($request->permissions);

        $this->logActivity(auth()->id(), request()->ip(), 'Store', 'Role', 'Role Store');

        toastr()->success('Role Created Successfully')->success('Permissions assigned to new Role');

        return redirect()->route('roles.index');
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
        $pageTitle = 'Edit Role';
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        $this->logActivity(auth()->id(), request()->ip(), 'Edit', 'Role', 'Role Edit');

        return view('admin.role.edit', compact('role', 'permissions', 'pageTitle'));
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
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'permissions' => 'required'
        ]);

        $role->update([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->permissions);

        $this->logActivity(auth()->id(), request()->ip(), 'Update', 'Role', 'Role Update');

        toastr()->success('Role Updated Successfully')->warning('Permissions Synced for Role');

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        // $role->syncPermissions();
        $role->delete();

        $this->logActivity(auth()->id(), request()->ip(), 'Destroy', 'Role', 'Role Destroy');

        toastr()->success('Role Deleted Successfully');

        return redirect()->route('roles.index');
    }
}

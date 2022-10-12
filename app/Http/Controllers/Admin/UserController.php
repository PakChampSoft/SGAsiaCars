<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Users';

        $query = User::query();

        if(request()->filled('from')){
            $query->whereDate('created_at', '>=',  request()->from);
        }

        if(request()->filled('to')){
            $query->whereDate('created_at', '<=' ,request()->to);
        }

        $query->whereNotIn('id', [auth()->id()]);
        $query->with('roles');
        $query->latest();

        $users = $query->paginate(10);

        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'User', 'User Index');

        return view('admin.user.index', compact('users', 'pageTitle'));

    }

    // vendors only
    public function vendorsIndex()
    {
        $pageTitle = 'Vendors';

        $query = User::query();

        $query->role('vendor');
        // $query->whereHas('roles', function($qry){
        //     $qry->where('name', 'vendor');
        // });

        if(request()->filled('from')){
            $query->whereDate('created_at', '>=',  request()->from);
        }

        if(request()->filled('to')){
            $query->whereDate('created_at', '<=' ,request()->to);
        }

        $query->with('roles');
        $query->latest();

        $users = $query->paginate(10);

        $this->logActivity(auth()->id(), request()->ip(), 'VendorsIndex', 'User', 'User VendorsIndex');

        return view('admin.user.index', compact('users', 'pageTitle'));
    }

    // customers only
    public function customersIndex()
    {
        $pageTitle = 'Customers';

        $query = User::query();

        $query->role('customer');

        // $query->whereHas('roles', function($qry){
        //     $qry->where('name', 'customer');
        // });

        if(request()->filled('from')){
            $query->whereDate('created_at', '>=',  request()->from);
        }

        if(request()->filled('to')){
            $query->whereDate('created_at', '<=' ,request()->to);
        }

        $query->with('roles');
        $query->latest();

        $users = $query->paginate(10);

        $this->logActivity(auth()->id(), request()->ip(), 'CustomerIndex', 'User', 'User CustomerIndex');

        return view('admin.user.index', compact('users', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create User';

        $roles = Role::all();

        $this->logActivity(auth()->id(), request()->ip(), 'Create', 'User', 'User Create');

        return view('admin.user.create', compact('roles', 'pageTitle'));
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
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        $this->logActivity(auth()->id(), request()->ip(), 'Store', 'User', 'User Store');

        toastr()->success('User Created Successfully');

        return redirect()->route('users.index');
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
        $pageTitle = 'Edit User';

        $user = User::findOrFail($id);

        $roles = Role::all();

        $this->logActivity(auth()->id(), request()->ip(), 'Edit', 'User', 'User Edit');

        return view('admin.user.edit', compact('user', 'roles', 'pageTitle'));
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
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
        ]);

        $password = $user->password;
        if($request->has('password') && $request->filled('password')){
            $password = Hash::make($request->password);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $password
        ]);

        if($request->has('role') && $request->filled('role')){
            $user->syncRoles($request->role);
        }

        $this->logActivity(auth()->id(), request()->ip(), 'Update', 'User', 'User Update');

        toastr()->success('User Updated Successfully');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        $this->logActivity(auth()->id(), request()->ip(), 'Destroy', 'User', 'User Destroy');

        toastr()->success('User Deleted Successfully');

        return redirect()->back();
    }
}

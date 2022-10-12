<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Companies';

        $companies = Company::paginate(10);

        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'Company', 'Company Index');

        return view('admin.company.index', compact('companies', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create Company';

        $this->logActivity(auth()->id(), request()->ip(), 'Create', 'Company', 'Company Create');

        return view('admin.company.create', compact('pageTitle'));
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

        $company = Company::create([
            'name' => $request->name,
            'status' => 1
        ]);

        $this->logActivity(auth()->id(), request()->ip(), 'Store', 'Company', 'Company Store');

        toastr()->success('Company Created Successfully');

        return redirect()->route('companies.index');
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
        $pageTitle = 'Edit Company';

        $company = Company::findOrFail($id);

        $this->logActivity(auth()->id(), request()->ip(), 'Edit', 'Company', 'Company Edit');

        return view('admin.company.edit', compact('company', 'pageTitle'));
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
        $company = Company::findOrFail($id);

        $request->validate([
            'name' => 'required'
        ]);

        $company->update([
            'name' => $request->name,
        ]);

        $this->logActivity(auth()->id(), request()->ip(), 'Update', 'Company', 'Company Update');

        toastr()->success('Company Updated Successfully');

        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        $company->delete();

        $this->logActivity(auth()->id(), request()->ip(), 'Destroy', 'Company', 'Company Destroy');

        toastr()->success('Company Deleted Successfully');

        return redirect()->back();
    }
}

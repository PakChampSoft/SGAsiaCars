<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\VModel;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Models';

        $models = VModel::with('company')->orderBy('id', 'desc')->paginate(10);

        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'VModel', 'VModel Index');

        return view('admin.model.index', compact('models', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create Model';

        $companies = Company::all();

        $this->logActivity(auth()->id(), request()->ip(), 'Create', 'VModel', 'VModel Create');

        return view('admin.model.create', compact('companies', 'pageTitle'));
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
            'company' => 'required',
            'name' => 'required'
        ]);

        $model = VModel::create([
            'company_id' => $request->company,
            'name' => $request->name
        ]);

        $this->logActivity(auth()->id(), request()->ip(), 'Store', 'VModel', 'VModel Store');

        toastr()->success('Model Created Successfully');

        return redirect()->route('models.index');
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
        $pageTitle = 'Edit Model';

        $model = VModel::findOrFail($id);

        $companies = Company::all();

        $this->logActivity(auth()->id(), request()->ip(), 'Edit', 'VModel', 'VModel Edit');

        return view('admin.model.edit', compact('model', 'companies', 'pageTitle'));
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
        $model = VModel::findOrFail($id);

        $request->validate([
            'company' => 'required',
            'name' => 'required'
        ]);

        $model->update([
            'company_id' => $request->company,
            'name' => $request->name
        ]);

        $this->logActivity(auth()->id(), request()->ip(), 'Update', 'VModel', 'VModel Update');

        toastr()->success('Model Updated Successfully');

        return redirect()->route('models.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = VModel::findOrFail($id);

        $model->delete();

        $this->logActivity(auth()->id(), request()->ip(), 'Destroy', 'VModel', 'VModel Destroy');

        toastr()->success('Model Deleted Successfully');

        return redirect()->back();
    }
}

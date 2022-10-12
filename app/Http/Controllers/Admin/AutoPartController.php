<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Autopart;
use App\Models\AutopartPhoto;
use App\Models\Company;
use App\Models\Country;
use App\Models\VModel;
use Illuminate\Http\Request;

class AutoPartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageTitle = 'Autoparts';
        $query = Autopart::with('apcompany', 'apmodel');

        if($request->filled('ref_no')){
            $query->where('ref_no', $request->ref_no);
        }

        $query->orderBy('id', 'desc');

        $autoparts = $query->paginate(10);

        return view('admin.part.index', compact('autoparts', 'pageTitle'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create Autopart';

        $companies = Company::all();
        $models = VModel::all();
        $countries = Country::all();

        return view('admin.part.create', compact('companies', 'models', 'countries', 'pageTitle'));

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
            'ref_no' => 'required|unique:autopart,ref_no',
            'company' => 'required',
            'model' => 'required',
            'country' => 'required',
            'from_year' => 'required',
            'to_year' => 'required',
            'registration_date' => 'required',
            'condition' => 'required',
            'product_name' => 'required',
            'model_code' => 'required',
            'auto_parts_maker' => 'required',
            'price' => 'required',
            'thumbnail' => 'required'
        ]);

        $autopart = Autopart::create([
            'ref_no' => $request->ref_no,
            'company' => $request->company,
            'vmodel' => $request->model,
            'country' => $request->country,
            'from_year' => $request->from_year,
            'to_year' => $request->to_year,
            'registration_date' => $request->registration_date,
            'condition' => $request->condition,
            'product_name' => $request->product_name,
            'model_code' => $request->model_code,
            'auto_parts_maker' => $request->auto_parts_maker,
            'price' => $request->price,
            'fuel' => $request->fuel,
            'drive' => $request->drive_type,
            'mission_type' => $request->mission_type,
            'mileage' => $request->mileage,
            'engine_model' => $request->engine_model,
            'engine_size' => $request->engine_size,
            'genuine_parts_no' => $request->genuine_parts_no,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        if($autopart){
            if($request->hasFile('thumbnail')){
                $file = $request->file('thumbnail');
                $path = $file->store('public/autoparts');
                $autopart->main_image_name = $path;
                $autopart->save();
            }

            if($request->hasFile('gallary')){
                $files = $request->file('gallary');

                foreach($files as $file){
                    $path = $file->store('public/autoparts');

                    AutopartPhoto::create([
                        'autopart_id' => $autopart->id,
                        'name' => $path
                    ]);
                }
            }
        }

        toastr()->success('Autopart Created Successfully');

        return redirect()->route('parts.index');

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
        $pageTitle = 'Edit Autopart';

        $autopart = Autopart::with('photos')->findOrFail($id);

        $companies = Company::all();
        $models = VModel::all();
        $countries = Country::all();

        return view('admin.part.edit', compact('autopart', 'companies', 'models', 'countries', 'pageTitle'));
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
        $autopart = Autopart::findOrFail($id);

        $request->validate([
            'ref_no' => 'required|unique:autopart,ref_no,'. $autopart->id,
            'company' => 'required',
            'model' => 'required',
            'country' => 'required',
            'from_year' => 'required',
            'to_year' => 'required',
            'registration_date' => 'required',
            'condition' => 'required',
            'product_name' => 'required',
            'model_code' => 'required',
            'auto_parts_maker' => 'required',
            'price' => 'required',
        ]);

        $autopart->update([
            'ref_no' => $request->ref_no,
            'company' => $request->company,
            'vmodel' => $request->model,
            'country' => $request->country,
            'from_year' => $request->from_year,
            'to_year' => $request->to_year,
            'registration_date' => $request->registration_date,
            'condition' => $request->condition,
            'product_name' => $request->product_name,
            'model_code' => $request->model_code,
            'auto_parts_maker' => $request->auto_parts_maker,
            'price' => $request->price,
            'fuel' => $request->fuel,
            'drive' => $request->drive_type,
            'mission_type' => $request->mission_type,
            'mileage' => $request->mileage,
            'engine_model' => $request->engine_model,
            'engine_size' => $request->engine_size,
            'genuine_parts_no' => $request->genuine_parts_no,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        if($autopart){
            if($request->hasFile('thumbnail')){
                $file = $request->file('thumbnail');
                $path = $file->store('public/autoparts');
                $autopart->main_image_name = $path;
                $autopart->save();
            }

            if($request->hasFile('gallary')){
                $files = $request->file('gallary');

                foreach($files as $file){
                    $path = $file->store('public/autoparts');

                    AutopartPhoto::create([
                        'autopart_id' => $autopart->id,
                        'name' => $path
                    ]);
                }
            }
        }

        toastr()->success('Autopart Updated Successfully');

        return redirect()->route('parts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $autopart = Autopart::findOrFail($id);

        $autopart->delete();

        toastr()->success('Autopart Deleted Successfully');

        return redirect()->back();
    }
}

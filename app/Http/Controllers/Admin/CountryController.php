<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Countries';

        $countries = Country::paginate(10);

        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'Country', 'Country Index');

        return view('admin.country.index', compact('countries', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create Country';

        $this->logActivity(auth()->id(), request()->ip(), 'Create', 'Country', 'Country Create');

        return view('admin.country.create', compact('pageTitle'));
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

        $country = Country::create([
            'name' => $request->name
        ]);

        $this->logActivity(auth()->id(), request()->ip(), 'Store', 'Country', 'Country Store');

        toastr()->success('Country Created Successfully');

        return redirect()->route('countries.index');
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
        $pageTitle = 'Edit Country';

        $country = Country::findOrFail($id);

        $this->logActivity(auth()->id(), request()->ip(), 'Edit', 'Country', 'Country Edit');

        return view('admin.country.edit', compact('country','pageTitle'));
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
        $country = Country::findOrFail($id);

        $request->validate([
            'name' => 'required'
        ]);

        $country->update([
            'name' => $request->name
        ]);

        $this->logActivity(auth()->id(), request()->ip(), 'Update', 'Country', 'Country Update');

        toastr()->success('Country Upated Successfully');

        return redirect()->route('countries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::findOrFail($id);

        $country->delete();

        $this->logActivity(auth()->id(), request()->ip(), 'Destroy', 'Country', 'Country Destroy');

        toastr()->success('Country Deleted Successfully');

        return redirect()->back();
    }
}

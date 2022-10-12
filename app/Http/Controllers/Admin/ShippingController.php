<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Shipping Schdule';

        $shippings = Shipping::all();

        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'Shipping', 'Shipping Index');

        return view('admin.shipping.index', compact('shippings', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $pageTitle = 'Edit Shipping Schedule';

        $shipping = Shipping::findOrFail($id);

        $this->logActivity(auth()->id(), request()->ip(), 'Edit', 'Shipping', 'Shipping Edit');

        return view('admin.shipping.edit', compact('shipping', 'pageTitle'));
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
        $shipping = Shipping::findOrFail($id);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = $file->store('public/shipping');
            $shipping->image = $path;
        }

        if($request->hasFile('document')){
            $file = $request->file('document');
            $path = $file->store('public/shipping');
            $shipping->document = $path;
        }

        $shipping->save();

        $this->logActivity(auth()->id(), request()->ip(), 'Update', 'Shipping', 'Shipping Update');

        toastr()->success('Shipping Schedule Updated Successfully');

        return redirect()->route('shippings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

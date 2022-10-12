<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "Product Meta";
        $products = Product::select(['id', 'ref_no', 'company', 'type'])
                    ->with(['vcompany' => function($qry){
                        $qry->select(['id', 'name']);
                    }, 'vtype' => function($qry){
                        $qry->select(['id', 'name']);
                    }])->get();

        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'Meta', 'Meta Index');
        // dd($products->toArray());
        return view('admin.meta.index', compact('products', 'pageTitle'));
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
        $pageTitle = "Product Meta";

        $products = Product::select(['id', 'ref_no', 'company', 'type'])
                    ->with(['vcompany' => function($qry){
                        $qry->select(['id', 'name']);
                    }, 'vtype' => function($qry){
                        $qry->select(['id', 'name']);
                    }])->get();

        $product = Product::where('id', $id)
                    ->select(['id', 'meta_title', 'meta_description'])
                    ->firstOrFail();
        // dd($products->toArray());
        $this->logActivity(auth()->id(), request()->ip(), 'Edit', 'Meta', 'Meta Edit');

        return view('admin.meta.edit', compact('product', 'products', 'pageTitle'));
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
        $product = Product::findOrFail($id);

        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;

        $product->save();

        $this->logActivity(auth()->id(), request()->ip(), 'Update', 'Meta', 'Meta Update');

        toastr()->success('Product Meta Updated');

        return redirect()->back();
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

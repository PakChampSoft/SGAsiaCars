<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallary;
use App\Models\Product;
use Illuminate\Http\Request;

class GallaryController extends Controller
{

    public function show($product_id)
    {
        $pageTitle = "Product Gallary";

        $gallary = Gallary::where('product_id', $product_id)->get();

        $this->logActivity(auth()->id(), request()->ip(), 'Show', 'Gallary', 'Gallary Show');

        return view('admin.product_gallary.index', compact('gallary', 'pageTitle'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallary = Gallary::findOrFail($id);

        $gallary->delete();

        $this->logActivity(auth()->id(), request()->ip(), 'Destroy', 'Gallary', 'Gallary Destroy');

        toastr()->success('Photo Deleted Successfully');

        return redirect()->back();
    }

    public function destroyAll($id)
    {
        $gallary = Gallary::where('product_id', $id)->get();

        foreach($gallary as $photo){
            $photo->delete();
        }

        $this->logActivity(auth()->id(), request()->ip(), 'DestroyAll', 'Gallary', 'Gallary DestroyAll');

        toastr()->success('All Photos Deleted Successfully');

        return redirect()->back();
    }

    public function bulkUpdate(Request $request)
    {
        // dd($request->all());

        if($request->filled('ordered')){
            $images = explode(",", $request->ordered);
            $order = 0;
            foreach($images as $image){
                $i = Gallary::find($image);
                if($i){
                    $i->sorting_order = $order;
                    $i->is_private = 0;
                    $i->save();
                    $order++;
                }
            }
        }

        if($request->filled('privated')){
            $images = explode(",", $request->privated);
            foreach($images as $image){
                $i = Gallary::find($image);
                if($i){
                    $i->is_private = 1;
                    $i->save();
                }
            }
        }

        if($request->filled('trashed')){
            // dd($request->trashed);
            $images = explode(",", $request->trashed);
            foreach($images as $image){
                $i = Gallary::find($image);
                if($i){
                    $i->delete();
                }
            }
        }

        $this->logActivity(auth()->id(), request()->ip(), 'BulkUpdate', 'Gallary', 'Gallary BulkUpdate');

        toastr()->success("Image settings saved");

        return redirect()->back();
    }
}

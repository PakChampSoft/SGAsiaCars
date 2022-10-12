<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accessory;
use App\Models\Color;
use App\Models\Company;
use App\Models\Country;
use App\Models\Deal;
use App\Models\Gallary;
use App\Models\Product;
use App\Models\Type;
use App\Models\VModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Image;

// use ZanySoft\Zip\Zip;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageTitle = 'Products';

        $query = Product::with('vcompany', 'v_model');

        if($request->filled('ref_no')){
            $query->where('ref_no', $request->ref_no);
        }

        if($request->filled('chassis_no')){
            $query->where('chassis_no', $request->chassis_no);
        }

        if($request->filled('company')){
            $query->where('company', $request->company);
        }

        if($request->filled('model')){
            $query->where('vmodel', $request->model);
        }

        if($request->filled('type')){
            $query->where('type', $request->type);
        }

        if($request->filled('fuel')){
            $query->where('fuel_type', $request->fuel);
        }

        if($request->filled('drive_type')){
            $query->where('drive_type', $request->drive_type);
        }

        if($request->filled('status')){
            $query->where('sold', $request->status);
        }

        if($request->filled('transmission')){
            $query->where('transmission', $request->transmission);
        }

        if($request->filled('min_engine')){
            $query->where('engine_cc','>=', (int) $request->min_engine);
        }

        if($request->filled('max_engine')){
            $query->where('engine_cc','<=', (int) $request->max_engine);
        }

        if($request->filled('color')){
            $query->where('color', $request->color);
        }

        if($request->filled('country')){
            $query->where('country', $request->country);
        }

        if($request->filled('min_year')){
            $query->where('manufacture_date', '>=', $request->min_year);
        }

        if($request->filled('max_year')){
            $query->where('manufacture_date', '<=', $request->max_year);
        }

        if($request->filled('min_price')){
            $query->where('price', '>=', (int) $request->min_price);
        }

        if($request->filled('max_price')){
            $query->where('price', '<=', (int) $request->max_price);
        }


        $query->orderBy('id', 'desc');
        $products = $query->paginate(10);
        // dd($products->toArray());

        $companies = Company::withCount('products')->get();
        $models = VModel::withCount('products')->get();
        $types = Type::all();
        $colors = Color::all();
        $countries = Country::all();

        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'Product', 'Product Index');

        return view('admin.product.index', compact('companies', 'models', 'types', 'colors', 'countries', 'products', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create Product';

        $companies = Company::all();
        $models = VModel::all();
        $types = Type::all();
        $colors = Color::all();
        $countries = Country::all();
        $deals = Deal::all();
        $accessories = Accessory::all();

        $this->logActivity(auth()->id(), request()->ip(), 'Create', 'Product', 'Product Create');

        return view('admin.product.create', compact('companies', 'models', 'types', 'colors', 'countries', 'deals', 'accessories', 'pageTitle'));
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
            'ref_no' => 'required|unique:product,ref_no',
            'company' => 'required',
            // 'model' => 'required',
            'type' => 'required',
            'steering' => 'required',
            'transmission' => 'required',
            'fuel_type' => 'required',
            'color' => 'required',
            'country' => 'required',
            'mileage' => 'required',
            'engine_cc' => 'required',
            'chassis_no' => 'required',
            'grade' => 'required',
            'no_of_doors' => 'required',
            'seats' => 'required',
            'price' => 'required',
            'manufacture_date' => 'required',
            'accessories' => 'required',
            // 'thumbnail' => 'required',
            'drive_type' => 'required'
        ]);

        $product = Product::create([
            'user_id' => auth()->id(),
            'ref_no' => $request->ref_no,
            'company' => $request->company,
            // 'vmodel' => $request->model,
            'type' => $request->type,
            'steering' => $request->steering,
            'transmission' => $request->transmission,
            'fuel_type' => $request->fuel_type,
            'color' => $request->color,
            'country' => $request->country,
            'mileage' => $request->mileage,
            'engine_cc' => $request->engine_cc,
            'chassis_no' => $request->chassis_no,
            'grade' => $request->grade,
            'no_of_doors' => $request->no_of_doors,
            'seats' => $request->seats,
            'price' => $request->price,
            'manufacture_date' => $request->manufacture_date,
            'accessories' => implode(',', $request->accessories),
            'is_featured' => $request->featured,
            'discount' => $request->discount,
            'vedio' => $request->video,
            'meta_title' => $request->seo_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'sold' => 0,
            'drive_type' => $request->drive_type,
            'size' => $request->plength . ',' . $request->pwidth . ',' . $request->pheight,
            'deal' => $request->deal,
        ]);

        if($product){
            if($request->hasFile('thumbnail')){
                $path = 'product_photos/'.$product->ref_no.'';
                if(!File::exists(public_path($path))){
                    File::makeDirectory(public_path($path), 0777);
                }
                $thumbnail = $request->file('thumbnail');
                $tmpName = uniqid().'.'.$thumbnail->extension();

                if($file = $request->file('thumbnail')){
                    // $tmp = explode('.', $file->getClientOriginalName());//get client file name
                    // $name = $file->getClientOriginalName();
                    // $newImageName = round(microtime(true)).'.'.end($tmp);
                    // $file->move($path, $newImageName);


                   $file= $request->file('thumbnail');
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file->move($path, $filename);
                    $product->main_image_name = $path.'/'.$filename;
                }

            }
            $product->save();
            // MAIN THUMBNAIL
            if($request->hasFile('gallary')){

                $path = 'product_photos/'.$product->ref_no.'';
                if(!File::exists(public_path($path))){
                    File::makeDirectory(public_path($path), 0777);
                }

                $gallary = $request->file('gallary');

                foreach($gallary as $file){

                    // $tmpName = uniqid().'.'.$file->extension();
                    // $tmp = explode('.', $file->getClientOriginalName());//get client file name
                    // $name = $file->getClientOriginalName();
                    // $newImageName = round(microtime(true)).'.'.end($tmp);
                    // $file->move($path, $newImageName);
                    $filename= date('YmdHi').$file->getClientOriginalName();

                    $file->move($path, $filename);

                    Gallary::create([
                        'product_id' => $product->id,
                        'name' => $path.'/'.$filename
                    ]);
                }

            }
        }

        $this->logActivity(auth()->id(), request()->ip(), 'Store', 'Product', 'Product Store');

        toastr()->success('Product Created Successfully');

        return redirect()->route('products.index');
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
        $pageTitle = 'Edit Product';

        $product = Product::with('photos')->findOrFail($id);

        $companies = Company::all();
        $models = VModel::all();
        $types = Type::all();
        $colors = Color::all();
        $countries = Country::all();
        $deals = Deal::all();
        $accessories = Accessory::all();

        $this->logActivity(auth()->id(), request()->ip(), 'Edit', 'Product', 'Product Edit');


        return view('admin.product.edit', compact('product', 'companies', 'models', 'types', 'colors', 'countries', 'deals', 'accessories', 'pageTitle'));

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

        $request->validate([
            'ref_no' => 'required|unique:product,ref_no,'.$product->id,
            'company' => 'required',
            // 'model' => 'required',
            'type' => 'required',
            'steering' => 'required',
            'transmission' => 'required',
            'fuel_type' => 'required',
            'color' => 'required',
            'country' => 'required',
            'mileage' => 'required',
            'engine_cc' => 'required',
            'chassis_no' => 'required',
            // 'grade' => 'required',
            // 'no_of_doors' => 'required',
            // 'seats' => 'required',
            'price' => 'required',
            'manufacture_date' => 'required',
            // 'accessories' => 'required',
            // 'thumbnail' => 'required',
            'drive_type' => 'required'
        ]);
            $product->ref_no = $request->ref_no;
            $product->company = $request->company;
            $product->type = $request->type;
            $product->steering = $request->steering;
            $product->transmission = $request->transmission;
            $product->fuel_type = $request->fuel_type;
            $product->color = $request->color;
            $product->country = $request->country;
            $product->mileage = $request->mileage;
            $product->engine_cc = $request->engine_cc;
            $product->chassis_no = $request->chassis_no;
            $product->grade = $request->grade;
            if($request->filled('seats'))
            {
                $product->seats = $request->seats;

            }

            if($request->filled('no_of_doors'))
            {
                $product->no_of_doors = $request->no_of_doors;

            }
            $product->price = $request->price;
            $product->manufacture_date = $request->manufacture_date;

            if($request->filled('accessories'))
            {
                $product->accessories = implode(',', $request->accessories);

            }
            $product->is_featured = $request->featured;
            $product->discount = $request->discount;
            $product->vedio = $request->video;
            $product->meta_title = $request->seo_title;
            $product->meta_description = $request->meta_description;
            $product->meta_keywords = $request->meta_keywords;
            $product->drive_type = $request->drive_type;
            $product->size = $request->plength . ',' . $request->pwidth . ',' . $request->pheight;
            $product->deal = $request->deal;
            $product->update();
        // $p = $product->update([
        //     'ref_no' => $request->ref_no,
        //     'company' => $request->company,
        //     // 'vmodel' => $request->model,
        //     'type' => $request->type,
        //     'steering' => $request->steering,
        //     'transmission' => $request->transmission,
        //     'fuel_type' => $request->fuel_type,
        //     'color' => $request->color,
        //     'country' => $request->country,
        //     'mileage' => $request->mileage,
        //     'engine_cc' => $request->engine_cc,
        //     'chassis_no' => $request->chassis_no,
        //     'grade' => $request->grade,
        //     'no_of_doors' => $request->no_of_doors,
        //     'seats' => $request->seats,
        //     'price' => $request->price,
        //     'manufacture_date' => $request->manufacture_date,
        //     'accessories' => implode(',', $request->accessories),
        //     'is_featured' => $request->featured,
        //     'discount' => $request->discount,
        //     'vedio' => $request->video,
        //     'meta_title' => $request->seo_title,
        //     'meta_description' => $request->meta_description,
        //     'meta_keywords' => $request->meta_keywords,
        //     'drive_type' => $request->drive_type,
        //     'size' => $request->plength . ',' . $request->pwidth . ',' . $request->pheight,
        //     'deal' => $request->deal,
        // ]);

        if($product){
            // MAIN THUMBNAIL
            if($request->hasFile('thumbnail')){
                $path = 'product_photos/'.$product->ref_no.'';
                if(!File::exists(public_path($path))){
                    File::makeDirectory(public_path($path), 0777);
                }
                $thumbnail = $request->file('thumbnail');
                $tmpName = uniqid().'.'.$thumbnail->extension();

                if($file = $request->file('thumbnail')){
                    // $tmp = explode('.', $file->getClientOriginalName());//get client file name
                    // $name = $file->getClientOriginalName();
                    // $newImageName = round(microtime(true)).'.'.end($tmp);
                    // $file->move($path, $newImageName);


                    $file= $request->file('thumbnail');
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file->move($path, $filename);
                    $product->main_image_name = $path.'/'.$filename;
                }



            }

            $product->save();
            // MAIN THUMBNAIL

            if($request->hasFile('gallary')){

                $path = 'product_photos/'.$product->ref_no.'';
                if(!File::exists(public_path($path))){
                    File::makeDirectory(public_path($path), 0777);
                }

                $gallary = $request->file('gallary');

                foreach($gallary as $file){

                    // $tmpName = uniqid().'.'.$file->extension();
                    // $tmp = explode('.', $file->getClientOriginalName());//get client file name
                    // $name = $file->getClientOriginalName();
                    // $newImageName = round(microtime(true)).'.'.end($tmp);
                    // $file->move($path, $newImageName);
                    $filename= date('YmdHi').$file->getClientOriginalName();

                    $file->move($path, $filename);

                    Gallary::create([
                        'product_id' => $product->id,
                        'name' => $path.'/'.$filename
                    ]);
                }

            }
        }

        $this->logActivity(auth()->id(), request()->ip(), 'Update', 'Product', 'Product Update');

        toastr()->success('Product Updated Successfully');

        return redirect()->route('products.index');
    }

    // change product status
    public function updateStatus($id, Request $request)
    {
        // dd($request->all());
        $product = Product::findOrFail($id);
        $product->sold = $request->product_status;

        if($request->product_status == 3){
            $onhold_duration = $request->onhold_duration;
            $today = Carbon::now();
            $hold_duration = $today->addDays($onhold_duration);
            $product->onhold_duration = $hold_duration;
        }

        $product->save();

        $this->logActivity(auth()->id(), request()->ip(), 'UpdateStatus', 'Product', 'Product UpdateStatus');

        toastr()->success('Product Status Updated Successfully');

        return redirect()->back();
    }

    // download images in zip file
    public function zipImages($id)
    {
        $images = [];
        $product = Product::with('photos')->where('id', $id)->firstOrFail();
        $gallary = $product->photos->where('is_private', 0);

        if($gallary){
            try {
                foreach($gallary as $photo){
                    if($photo->name != null){
                        $images[] = $photo->name;
                    }
                }

                $zipFileName = $product->vcompany->name.'-'.$product->vtype->name.'-'.$product->ref_no.'.zip';
                // dd($zipFileName);
                if(!File::exists(public_path($zipFileName))){
                    touch(public_path($zipFileName));
                }

                $zip = new ZipArchive();
                $zip->open(public_path($zipFileName), (ZipArchive::CREATE | ZipArchive::OVERWRITE));

                foreach($images as $img){
                    $zip->addFile(public_path($img), basename($img));
                }

                $zip->close();

                $this->logActivity(auth()->id(), request()->ip(), 'ZipImages', 'Product', 'Product ZipImages');

                return response()->download(public_path($zipFileName), $zipFileName)->deleteFileAfterSend(true);
            } catch (\Throwable $th) {
                return $th->getMessage();
            }

        }
        else{
            return 'No Images Found';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        $this->logActivity(auth()->id(), request()->ip(), 'Destroy', 'Product', 'Product Destroy');

        toastr()->success('Product Deleted Successfully');

        return redirect()->back();
    }

    // bulk available
    function bulkAvailable(Request $request){
        // dd($request->all());
        if($request->filled('vehicles')){
            $avehicles = explode(",", $request->vehicles);
            foreach($avehicles as $vehicle){
                $product = Product::find($vehicle);
                if($product){
                    $product->sold = 0;
                    $product->save();
                }
            }
        }

        $this->logActivity(auth()->id(), request()->ip(), 'BulkAvailable', 'Product', 'Product BulkAvailable');

        toastr()->success('Bulk status changed');
        return redirect()->back();
    }

    // bulk un-available
    function bulkUnavailable(Request $request){
        // dd($request->all());
        if($request->filled('vehicles')){
            $avehicles = explode(",", $request->vehicles);
            foreach($avehicles as $vehicle){
                $product = Product::find($vehicle);
                if($product){
                    $product->sold = 4;
                    $product->save();
                }
            }
        }

        $this->logActivity(auth()->id(), request()->ip(), 'BulkUnavailable', 'Product', 'Product BulkUnavailable');

        toastr()->success('Bulk status changed');
        return redirect()->back();
    }


    // bulk sold
    function bulkSold(Request $request){
        // dd($request->all());
        if($request->filled('vehicles')){
            $avehicles = explode(",", $request->vehicles);
            foreach($avehicles as $vehicle){
                $product = Product::find($vehicle);
                if($product){
                    $product->sold = 1;
                    $product->save();
                }
            }
        }

        $this->logActivity(auth()->id(), request()->ip(), 'BulkSold', 'Product', 'Product BulkSold');

        toastr()->success('Bulk status changed');
        return redirect()->back();
    }

    // bulk onhold
    function bulkOnhold(Request $request){
        // dd($request->all());
        if($request->filled('vehicles')){
            $avehicles = explode(",", $request->vehicles);
            foreach($avehicles as $vehicle){
                $product = Product::find($vehicle);
                if($product){
                    $product->sold = 3;

                    $onhold_duration = $request->onhold_duration ?? 2;
                    $today = Carbon::now();
                    $hold_duration = $today->addDays($onhold_duration);
                    $product->onhold_duration = $hold_duration;

                    $product->save();
                }
            }
        }

        $this->logActivity(auth()->id(), request()->ip(), 'BulkOnHold', 'Product', 'Product BulkOnHold');

        toastr()->success('Bulk status changed');
        return redirect()->back();
    }
}

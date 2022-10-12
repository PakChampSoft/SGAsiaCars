<?php

use App\Models\Port;
use App\Models\Product;
use App\Models\VModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// get location of user
Route::get('location', function(){
    // $ip = request()->ip();
    $ip = '182.191.114.209';

    $location = \Location::get($ip);

    return $location->countryName;
});

// get country ports
Route::get('/ports/{id}', function($id){
    $ports = Port::where('country_id', $id)->get();

    return $ports;
});

// get models against company
Route::get('/models', function(Request $request){

    $query = VModel::query();
    if($request->filled('company')){
        $query->where('company_id', $request->company);
    }

    $models = $query->withCount(['products' => function($qry){
        $qry->where('sold', '!=', 4);
    }])->get();

    return $models;
});


// get stock quantity
Route::get('/stock/quantity', function(Request $request){

    $query = Product::orderBy('id', 'desc');

        if($request->filled('ref_no')){
            $query->where('ref_no', $request->ref_no);
        }

        if($request->filled('chassis_no')){
            $query->where('chassis_no', $request->chassis_no);
        }

        if($request->filled('maker')){
            $query->where('company', $request->maker);
        }
        if($request->filled('company')){
            $query->where('company', $request->company);
        }

        if($request->filled('model')){
            $query->where('vmodel', $request->model);
        }

        if($request->filled('vehicle_model')){
            $query->where('vmodel', $request->vehicle_model);
        }

        if($request->filled('type')){
            $query->where('type', $request->type);
        }

        if($request->filled('color')){
            $query->where('color', $request->color);
        }

        if($request->filled('fuel')){
            $query->where('fuel_type', $request->fuel);
        }

        if($request->filled('year_from')){
            $query->where('manufacture_date', '>=', $request->year_from);
        }
        if($request->filled('min_year')){
            $query->where('manufacture_date', '>=', $request->min_year);
        }

        if($request->filled('year_to')){
            $query->where('manufacture_date', '<=', $request->year_to);
        }
        if($request->filled('max_year')){
            $query->where('manufacture_date', '<=', $request->max_year);
        }

        if($request->filled('enginecc_from')){
            $query->where('engine_cc', '>=', (int) $request->enginecc_from);
        }
        if($request->filled('min_engine')){
            $query->where('engine_cc', '>=', (int) $request->min_engine);
        }

        if($request->filled('enginecc_to')){
            $query->where('engine_cc', '<=', (int) $request->enginecc_to);
        }
        if($request->filled('max_engine')){
            $query->where('engine_cc', '<=', (int) $request->max_engine);
        }

        if($request->filled('min_price')){
            $query->where('price', '>=', (int) $request->min_price);
        }

        if($request->filled('max_price')){
            $query->where('price', '<=', (int) $request->max_price);
        }

        if($request->filled('drive_type')){
            $query->where('drive_type', $request->drive_type);
        }

        if($request->filled('transmission')){
            $query->where('transmission', $request->transmission);
        }

        if($request->filled('steering')){
            $query->where('steering', $request->steering);
        }

        if($request->filled('min_seats')){
            $query->where('seats', '>=', (int) $request->min_seats);
        }

        if($request->filled('max_seats')){
            $query->where('seats', '<=', (int) $request->max_seats);
        }

        if(request()->filled('min_mileage')){
            $query->where('mileage', '>=', (int) $request->min_mileage);
        }

        if(request()->filled('max_mileage')){
            $query->where('mileage', '<=', (int) $request->max_mileage);
        }

        if($request->filled('stock_country')){
            $query->where('country', $request->stock_country);
        }

        if($request->filled('featured')){
            $query->where('is_featured', $request->featured);
        }

        if($request->filled('deal')){
            $query->where('deal', $request->deal);
        }

        if($request->filled('deals')){
            $query->whereIn('deal', $request->deals);
        }

        if($request->filled('asscs')){
            $accessories = $request->asscs;
            $query->where('accessories', implode(',',$accessories));
        }

        $query->where('sold', '!=', 4);

        $products_quantity = $query->count();

        return $products_quantity;

});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/blog/image', function(Request $request){

    if($request->hasFile('file')){
        $file = $request->file('file');

        $fileName = uniqid().'.'.$file->extension();
        // $rpath = $request->file('file')->storeAs(public_path('blogs'), $fileName);
        $file->move(public_path('/blogs'), $fileName);
    }

    // dd($rpath)
    return asset('blogs/'.$fileName);
});

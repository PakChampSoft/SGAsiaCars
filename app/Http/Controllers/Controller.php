<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Company;
use App\Models\Country;
use App\Models\Product;
use App\Models\Type;
use App\Models\UserActivity;
use App\Models\VModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Stevebauman\Location\Facades\Location;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {

        // countries session
        if(session()->missing('countries')){
            $countries = Country::all();
            session(['countries' => $countries]);
        }

        // makers/companies session
        if(session()->missing('companies')){
            $companies = Company::withCount(['products' => function($qry){
                $qry->where('sold', '!=', 4);
            }])->get();
            session(['companies' => $companies]);
        }

        // models session
        if(session()->missing('models')){
            $models = VModel::withCount(['products' => function($qry){
                $qry->where('sold', '!=', 4);
            }])->get();
            session(['models' => $models]);
        }

        // types session
        if(session()->missing('types')){
            $types = Type::all();
            session(['types' => $types]);
        }

        // colors session
        if(session()->missing('colors')){
            $colors = Color::all();
            session(['colors' => $colors]);
        }

        // Toyota session
        if(session()->missing('toyota')){
            $toyota = Product::WhereHas('vcompany', function($q){
                $q->where('name','like', '%TOYOTA%');
            })
            ->count();
            session(['toyota' => $toyota]);
        }
        // nissan session
        if(session()->missing('nissan')){
            $nissan = Product::WhereHas('vcompany', function($q){
                $q->where('name','like', '%NISSAN%');
            })
            ->count();
            session(['nissan' => $nissan]);
        }
        // ISUZU session
        if(session()->missing('ISUZU')){
            $ISUZU = Product::WhereHas('vcompany', function($q){
                $q->where('name','like', '%ISUZU%');
            })
            ->count();
            session(['ISUZU' => $ISUZU]);
        }
        // MITSUBISHI session
        if(session()->missing('MITSUBISHI')){
            $MITSUBISHI = Product::WhereHas('vcompany', function($q){
                $q->where('name','like', '%MITSUBISHI%');
            })
            ->count();
            session(['MITSUBISHI' => $MITSUBISHI]);
        }
        // FORD session
        if(session()->missing('FORD')){
            $FORD = Product::WhereHas('vcompany', function($q){
                $q->where('name','like', '%FORD%');
            })
            ->count();
            session(['FORD' => $FORD]);
        }

        // CHEVROLET session
        if(session()->missing('CHEVROLET')){
            $CHEVROLET = Product::WhereHas('vcompany', function($q){
                $q->where('name','like', '%CHEVROLET%');
            })
            ->count();
            session(['CHEVROLET' => $CHEVROLET]);
        }
         // SINGLE_CAB session
        if(session()->missing('SINGLE_CAB')){
            $SINGLE_CAB = Product::WhereHas('vtype', function($q){
                $q->where('name','like', '%SINGLE CAB%');
            })
            ->count();
            session(['SINGLE_CAB' => $SINGLE_CAB]);
        }
         // DOUBLE_CAB session
         if(session()->missing('DOUBLE_CAB')){
            $DOUBLE_CAB = Product::WhereHas('vtype', function($q){
                $q->where('name','like', '%DOUBLE CAB%');
            })
            ->count();
            session(['DOUBLE_CAB' => $DOUBLE_CAB]);
        }
         // SMART_CAB session
         if(session()->missing('SMART_CAB')){
            $SMART_CAB = Product::WhereHas('vtype', function($q){
                $q->where('name','like', '%SMART CAB%');
            })
            ->count();
            session(['SMART_CAB' => $SMART_CAB]);
        }
         // PICK_UP session
         if(session()->missing('PICK_UP')){
            $PICK_UP = Product::WhereHas('vtype', function($q){
                $q->where('name','like', '%PICK UP%');
            })
            ->count();
            session(['PICK_UP' => $PICK_UP]);
        }
         // SEDAN session
         if(session()->missing('SEDAN')){
            $SEDAN = Product::WhereHas('vtype', function($q){
                $q->where('name','like', '%SEDAN%');
            })
            ->count();
            session(['SEDAN' => $SEDAN]);
        }
         // SUV session
         if(session()->missing('SUV')){
            $SUV = Product::WhereHas('vtype', function($q){
                $q->where('name','like', '%SUV%');
            })
            ->count();
            session(['SUV' => $SUV]);
        }
         // VAN session
         if(session()->missing('VAN')){
            $VAN = Product::WhereHas('vtype', function($q){
                $q->where('name','like', '%VAN%');
            })
            ->count();
            session(['VAN' => $VAN]);
        }
         // THILAND session
         if(session()->missing('THAILAND')){
            $THILAND = Product::WhereHas('vcountry', function($q){
                $q->where('name','like', '%Thailand%');
            })
            ->count();
            session(['THAILAND' => $THILAND]);
        }
         // UAE session
         if(session()->missing('UAE')){
            $UAE = Product::WhereHas('vcountry', function($q){
                $q->where('name','like', '%UAE%');
            })
            ->count();
            session(['UAE' => $UAE]);
        }
         // Diesel session
         if(session()->missing('Diesel')){
            $Diesel = Product::where('fuel_type','like', '%Diesel%')
            ->count();
            session(['Diesel' => $Diesel]);
        }
         // Diesel session
         if(session()->missing('Petrol')){
            $Petrol = Product::where('fuel_type','like', '%Petrol%')
            ->count();
            session(['Petrol' => $Petrol]);
        }
         // Hybird session
         if(session()->missing('Hybrid')){
            $Hybrid = Product::where('fuel_type','like', '%Hybrid%')
            ->count();
            session(['Hybrid' => $Hybrid]);
        }
    }

    public function getLocation()
    {
        $ip = request()->ip();
        // $ip = '182.191.114.209';

        $location = Location::get($ip);

        // dd($location);
        if($location != null){
            return $location->countryName;
        }

        return 'UAE';
    }

    public function logActivity($user, $ip, $activity, $module, $details)
    {
        try {
            $userActivity = UserActivity::create([
                'user_id' => $user ?? 0,
                'ip_address' => $ip,
                'activity' => $activity,
                'module' => $module,
                'activity_details' => $details
            ]);
        } catch (\Throwable $th) {
            Log::log("user-activity", $th->getMessage());
        }
    }
}

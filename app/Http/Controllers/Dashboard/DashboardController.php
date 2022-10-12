<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\LoginActivity;
use App\Models\Port;
use App\Models\Product;
use App\Models\ProductNotifcation;
use App\Models\Quote;
use App\Models\SiteClone;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        // change roles then remove this line when finish
        if(auth()->user()->hasRole('admin')){
            $clones = SiteClone::count();

            $clients = User::whereHas('roles', function($qry){
                $qry->where('name', 'customer');
            })->count();
            $vendors = User::whereHas('roles', function($qry){
                $qry->where('name', 'vendor');
            })->count();
            $totalUsers =User::count();

            $countries = Country::count();

            $ports = Port::count();

            $products = Product::count();

            $availableProducts = Product::where('sold', 0)->count();
            $soldProducts = Product::where('sold', 1)->count();
            $inOfferProducts = Product::where('sold', 2)->count();
            $onHoldProducts = Product::where('sold', 3)->count();


            $userLogs = LoginActivity::count();

            return view('dashboard', compact('clones', 'clients', 'vendors', 'totalUsers', 'countries', 'ports', 'products', 'userLogs', 'availableProducts', 'soldProducts', 'inOfferProducts', 'onHoldProducts'));
        }

        if(auth()->user()->hasRole('customer')){

            $quotes = Quote::where('user_id', auth()->id())->count();
            $notifications = ProductNotifcation::where('user_id', auth()->id())->count();

            return view('dashboard', compact('quotes', 'notifications'));
        }
    }
}

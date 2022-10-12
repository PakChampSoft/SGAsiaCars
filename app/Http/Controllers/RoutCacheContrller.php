<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class RoutCacheContrller extends Controller
{
    //
    public function index()
    {
        // php artisan route:cache
        // php artisan route:clear
        // php artisan config:cache
        // php artisan config:clear
        // php artisan optimize

        \Artisan::call('cache:clear');
        \Artisan::call('route:cache');
        \Artisan::call('route:clear');
        \Artisan::call('config:cache');
        \Artisan::call('config:clear');
        \Artisan::call('view:cache');
        \Artisan::call('view:clear');
        \Artisan::call('optimize:clear');
        return "All Routes Are Cleared";
    }

    public function clean_mileage()
    {
        // Cleaning Milate and Remove km
        // $products =  Product::where('mileage', 'LIKE', '%'. 'km'. '%')->get();
        // foreach ($products as $pro) {
        // $mileage = explode(" ", $pro->mileage);
        // $first = $mileage[0];
        // $prod = Product::findOrFail($pro->id);
        // $prod->mileage = $first;
        // $prod->update();
        // }


        // Cleaning Milage and Removing - etc 2000-4000
        $products =  Product::where('mileage', 'LIKE', '%'. '-'. '%')->get();
        foreach ($products as $pro) {
            # code...
            $mileage = explode("-", $pro->mileage);
            $first = $mileage[1];
            $prod = Product::findOrFail($pro->id);
            $prod->mileage = $first;
            $prod->update();

        }
        return 1;
    }

    public function thanks()
    {
        return view('new_website.thank-you');
    }
}

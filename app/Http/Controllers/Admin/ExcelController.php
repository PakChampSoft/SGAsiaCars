<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function index()
    {
        $pageTitle = 'Excel Management';

        $countries = Country::all();

        $vendors = User::whereHas('roles', function($qry){
            $qry->where('name', 'vendor');
        })->get();

        return view('admin.excel.index', compact('countries', 'vendors', 'pageTitle'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PreOrder;
use Illuminate\Http\Request;

class PreOrderController extends Controller
{
    public function create()
    {
        return view('pre-order');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'email' => 'required',
        ]);

        $preOrder = PreOrder::create([
            'product_id' => $request->product_id,
            'user_id' => auth()->id(),
            'user_email' => $request->email,
            'user_phone' => $request->phone,
        ]);

        toastr()->success('Your preorder request has been submitted successfully');

        return redirect()->back();
    }
}

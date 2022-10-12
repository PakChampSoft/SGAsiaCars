<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{

    public function myQuotes()
    {
        // dd('customer quotes');
        $pageTitle = "My Quotes";

        $query = Quote::where('user_id', auth()->id());

        if(request()->filled('from')){
            $query->whereDate('created_at', '>=',  request()->from);
        }

        if(request()->filled('to')){
            $query->whereDate('created_at', '<=' ,request()->to);
        }

        $query->with('product', 'product.vcompany', 'product.vtype');
        $quotes = $query->latest()->paginate(50);


        return view('customer.quote.index', compact('quotes', 'pageTitle'));
    }

}

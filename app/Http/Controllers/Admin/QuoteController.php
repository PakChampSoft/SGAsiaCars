<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quote;
use App\Rules\Recaptcha;
use App\Mail\QuoteRequest;
use App\Mail\QuoteRequested;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Quotes';

        $query = Quote::query();

        if(request()->filled('from')){
            $query->whereDate('created_at', '>=',  request()->from);
        }

        if(request()->filled('to')){
            $query->whereDate('created_at', '<=' ,request()->to);
        }

        $query->with('product', 'product.vcompany', 'product.vtype');
        $quotes = $query->latest()->paginate(10);

        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'Quote', 'Quote Index');
        // $quotes = Quote::with('product', 'product.vcompany', 'product.vtype')->latest('id')->paginate(10);

        return view('admin.quote.index', compact('quotes', 'pageTitle'));
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


        $request->validate([
            'product_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'country' => 'required',
            'address' => 'required',
            'city' => 'required',
            'tel' => 'required',
            'g-recaptcha-response' => ['required', new Recaptcha()],
        ]);
        // dd($request->all());
        $qoute = Quote::create([
            'user_id' => auth()->user()->id ?? 0,
            'productid' => $request->product_id,
            'fullname' => auth()->user()->name ?? $request->name,
            'email' => auth()->user()->email ?? $request->email,
            'country' => $request->country,
            'city' => $request->city,
            'address' => $request->address,
            'tel' => $request->tel,
            'message' => $request->message ?? ''
        ]);

        if($qoute){
            try {
                Mail::to($request->email)->send(new QuoteRequested($qoute));
                Mail::to(env('ADMIN_EMAIL'))->cc([env('CC_EMAIL')])->send(new QuoteRequest($qoute));
            } catch (\Throwable $th) {
                Log::debug($th->getMessage());
            }
        }

        $this->logActivity(auth()->id(), request()->ip(), 'Create', 'Quote', 'Quote Create');

        toastr()->success('Quotation Request Sent Successfully');
        return redirect()->route('after_query_submit', ['id' => $qoute->productid])->with('message', 'Thank You For Quotation, Our Team Will Contact You Soon.');
        // return redirect()->back()->with('message', 'Thank You For Quotation, Our Team Will Contact You Soon.');
    }

    public function after_query_submit()
    {
        return view('new_website.thank-you');
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
        //
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
        //
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

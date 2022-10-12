<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use Illuminate\Http\Request;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Deals';

        $deals = Deal::all();

        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'Deal', 'Deal Index');

        return view('admin.deal.index', compact('deals', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create Deal';

        $this->logActivity(auth()->id(), request()->ip(), 'Create', 'Deal', 'Deal Create');

        return view('admin.deal.create', compact('pageTitle'));
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
            'title' => 'required',
            'status' => 'required',
            'is_featured' => 'required',
            'icon' => 'required',
            'picture' => 'required',
        ]);

        $deal = Deal::create([
            'title' => $request->title,
            'status' => $request->status,
            'is_featured' => $request->is_featured,
            'icon' => '',
            'picture' => ''
        ]);

        if($deal){
            if($request->hasFile('icon')){
                $file = $request->file('icon');
                $path = $file->store('public/deals');

                $deal->icon = $path;
                $deal->save();
            }

            if($request->hasFile('picture')){
                $file = $request->file('picture');
                $path = $file->store('public/deals');

                $deal->picture = $path;
                $deal->save();
            }
        }

        $this->logActivity(auth()->id(), request()->ip(), 'Store', 'Deal', 'Deal Store');

        toastr()->success('Deal Created Successfully');

        return redirect()->route('deals.index');
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
        $pageTitle = 'Edit Deal';

        $deal = Deal::findOrFail($id);

        $this->logActivity(auth()->id(), request()->ip(), 'Edit', 'Deal', 'Deal Edit');

        return view('admin.deal.edit', compact('deal', 'pageTitle'));
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
        $deal = Deal::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'is_featured' => 'required',
        ]);

        $deal->update([
            'title' => $request->title,
            'status' => $request->status,
            'is_featured' => $request->is_featured,
        ]);

        if($deal){
            if($request->hasFile('icon')){
                $file = $request->file('icon');
                $path = $file->store('public/deals');

                $deal->icon = $path;
                $deal->save();
            }

            if($request->hasFile('picture')){
                $file = $request->file('picture');
                $path = $file->store('public/deals');

                $deal->picture = $path;
                $deal->save();
            }
        }

        $this->logActivity(auth()->id(), request()->ip(), 'Update', 'Deal', 'Deal Update');

        toastr()->success('Deal Updated Successfully');

        return redirect()->route('deals.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deal = Deal::findOrFail($id);

        $deal->delete();

        toastr()->success('Deal Deleted Successfully');

        $this->logActivity(auth()->id(), request()->ip(), 'Destroy', 'Deal', 'Deal Destroy');

        return redirect()->back();

    }
}

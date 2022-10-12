<?php

namespace App\Http\Controllers;

use App\Models\c;
use App\Models\PageMeta;
use Illuminate\Http\Request;

class PageMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $seos = PageMeta::orderBy('id', 'desc')->paginate(10);
        $pageTitle = "SEO Management";
        // dd($seos);
        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'Pages Meta', 'Pages Meta Index');

        return view('admin.seo.index', compact('seos', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $pageTitle = 'Create SEO';
        return view('admin.seo.create', compact('pageTitle'));
        dd("created");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'page_name' => 'required|unique:page_metas,page_name',
            'page_url' => 'required|unique:page_metas,page_url',
            'seo_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
        ]);
        $page_meta = new PageMeta();
        $page_meta->seo_title = $request->seo_title;
        $page_meta->meta_description = $request->meta_description;
        $page_meta->meta_keywords = $request->meta_keywords;
        $page_meta->page_url = $request->page_url;
        $page_meta->page_name = $request->page_name;
        $page_meta->save();
        $this->logActivity(auth()->id(), request()->ip(), 'Store', 'SEO Page', 'SEO Page Store');

        toastr()->success('SEO Page Created Successfully');

        return redirect()->route('seo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $page_meta = PageMeta::findOrFail($id);
        $pageTitle = "SEO Page Edit";
        return view('admin.seo.edit', compact('page_meta','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'seo_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
        ]);
        $page_meta = PageMeta::findorfail($id);
        $page_meta->seo_title = $request->seo_title;
        $page_meta->meta_description = $request->meta_description;
        $page_meta->meta_keywords = $request->meta_keywords;
        $page_meta->update();
        $this->logActivity(auth()->id(), request()->ip(), 'Update', 'SEO Page', 'SEO Page Updated');

        toastr()->success('SEO Page Updated Successfully');

        return redirect()->route('seo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $page_meta = PageMeta::findOrFail($id);

        $page_meta->delete();

        $this->logActivity(auth()->id(), request()->ip(), 'Destroy', 'SEO Page', 'SEO Page Destroy');

        toastr()->success('SEO Page Deleted Successfully');

        return redirect()->back();
    }
}

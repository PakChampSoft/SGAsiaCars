<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Content';

        $contents = Content::all();

        $this->logActivity(auth()->id(), request()->ip(), 'Index', 'Content', 'Content Index');

        return view('admin.content.index', compact('contents', 'pageTitle'));
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
        //
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
        $pageTitle = 'Edit Content';

        $content = Content::findOrFail($id);

        $this->logActivity(auth()->id(), request()->ip(), 'Edit', 'Content', 'Content Edit');

        return view('admin.content.edit', compact('content', 'pageTitle'));
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
        $content = Content::findOrFail($id);

        $request->validate([
            'pagetitle' => 'required',
            'pagename' => 'required',
            'content' => 'required',
        ]);

        $content->update([
            'pagetitle' => $request->pagetitle,
            'pagename' => $request->pagename,
            'content' => $request->content,
        ]);

        $this->logActivity(auth()->id(), request()->ip(), 'Update', 'Content', 'Content Update');

        toastr()->success('Content Updated Successfully');

        return redirect()->route('contents.index');
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

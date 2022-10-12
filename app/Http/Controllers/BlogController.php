<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\PageMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(10);
        $pageTitle = "Blogs";
        return view('admin.blog.index', compact('blogs', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Create Blog";

        return view('admin.blog.create', compact('pageTitle'));
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
            'content' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required'
        ]);

        $blog = Blog::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'content' => $request->content,
            'published_at' => $request->published_at,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords
         ]);

        if($blog){
            if($request->hasFile('main_image')){
                $path = 'public/blogs';
                $file= $request->file('main_image');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file->move($path, $filename);
                $blog->main_image = $path.'/'.$filename;
                $blog->save();
            }
        }

        toastr()->success('Blog added successfully');

        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = 'Edit Blog';
        $blog = Blog::findOrFail($id);
        // dd($blog->toArray());
        return view('admin.blog.edit', compact('blog', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required'
        ]);

        $blog = Blog::findOrFail($id);

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'published_at' => $request->published_at,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords
        ]);

        if($blog){
            if($request->hasFile('main_image')){
                $path = 'public/blogs';
                $file= $request->file('main_image');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file->move($path, $filename);
                $blog->main_image = $path.'/'.$filename;
                $blog->save();
            }
        }

        toastr()->success('Blog updated successfully');

        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        toastr()->success('Blog deleted successfull');

        return redirect()->back();
    }
}

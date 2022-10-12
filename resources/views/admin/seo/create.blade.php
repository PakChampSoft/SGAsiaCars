@extends('layouts.admin')

@section('content')
        <form class="form-row" method="POST" action="{{ route('seo.store') }}">
            @csrf
            <div class="form-group col-12">
                <label for="name">Page Name</label>
                <input type="text" name="page_name" id="page_name" class="form-control" >
            </div>
            <div class="form-group col-12">
                <label for="name">Page Url</label>
                <input type="text" name="page_url" id="page_url" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <label for="name">SEO Title</label>
                <input type="text" name="seo_title" id="seo_title" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <label for="name">Meta Description</label>
                <input type="text" name="meta_description" id="meta_description" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <label for="name">Meta Keywords</label>
                <input type="text" name="meta_keywords" id="meta_keywords" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Add" class="btn btn-sm btn-success float-right">
            </div>
        </form>
@endsection

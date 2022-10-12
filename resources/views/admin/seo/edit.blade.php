@extends('layouts.admin')

@section('content')
        <form class="form-row" method="POST" action="{{ route('seo.update', $page_meta->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group col-12">
                <label for="name">Page Name</label>
                <input type="text" name="page_name" id="page_name" value="{{ $page_meta->page_name }}" class="form-control" disabled>
            </div>
            <div class="form-group col-12">
                <label for="name">Page Url</label>
                <input type="text" name="page_url" id="page_url" value="{{ $page_meta->page_url }}" class="form-control" disabled>
            </div>
            <div class="form-group col-12">
                <label for="name">SEO Title</label>
                <input type="text" name="seo_title" id="seo_title" value="{{ $page_meta->seo_title }}" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <label for="name">Meta Description</label>
                <input type="text" name="meta_description" value="{{ $page_meta->meta_description }}" id="meta_description" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <label for="name">Meta Keywords</label>
                <input type="text" name="meta_keywords" id="meta_keywords" value="{{ $page_meta->meta_keywords }}" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Update" class="btn btn-sm btn-success float-right">
            </div>
        </form>
@endsection

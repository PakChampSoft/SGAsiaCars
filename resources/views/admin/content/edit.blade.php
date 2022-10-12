@extends('layouts.admin')

@section('content')
        <form class="form-row" method="POST" action="{{ route('contents.update', $content->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group col-12">
                <label for="pagetitle">Page Title</label>
                <input type="text" name="pagetitle" id="pagetitle" value="{{ $content->pagetitle }}" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <label for="pagename">Page Name</label>
                <input type="text" name="pagename" id="pagename" value="{{ $content->pagename }}" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <label for="content">Page Content</label>
                <textarea name="content" id="content" class="form-control">{{ $content->content }}</textarea>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Update" class="btn btn-sm btn-success float-right">
            </div>
        </form>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#content').summernote({
                height: 300,
            });
        });
    </script>
@endpush

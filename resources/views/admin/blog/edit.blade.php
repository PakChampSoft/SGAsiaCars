@extends('layouts.admin')

@section('content')
        <form class="form-row" method="POST" action="{{ route('blogs.update', $blog->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group col-12">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{ $blog->title }}" id="title" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <label for="meta_description">Meta Description</label>
                <input type="text" name="meta_description" value="{{ $blog->meta_description }}" id="meta_description" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <label for="meta_description">Meta Keywords</label>
                <input type="text" name="meta_keywords" value="{{ $blog->meta_keywords }}" id="meta_keywords" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <label for="content">Content</label>
                <textarea class="form-control" name="content" id="content" rows="10" required>{!! $blog->content !!}</textarea>
            </div>
            <div class="form-group col-6">
                <label for="published_at">Publishing Date</label>
                @php
                    $date = \Carbon\Carbon::today()->toDateString();
                @endphp
                <input type="date" value="{{ $blog->published_at ?? $date }}" class="form-control" name="published_at" id="published_at">
            </div>
            <div class="form-group col-12">
                <label for="main_image">Blog Image</label>
                <input type="file" name="main_image" id="main_image" class="form-control-file">
            </div>
            <div class="form-group col-12">
                <div id="img-preview">
                    <img src="{{ Storage::url($blog->main_image) }}" width="150" height="100" alt="main image">
                </div>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Update" class="btn btn-sm btn-success float-right">
            </div>
        </form>

        <div style="position: fixed; z-index: 10; width: 100%; height: 100%; inset: 0; background-color: lightgrey; display:none" id="img-upload-wait">
            <div style="display: flex; justify-content: center; align-items: center; width: 100%; height: 100%;">
                <h3>Uploading image... please wait</h3>
            </div>
        </div>
@endsection

@push('js')
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script> --}}
{{-- <script src="{{ asset('ckeditor/ckeditor.js') }}"></script> --}}
    <script>
        $(document).ready(function(){
            $('#content').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
                // maximumImageFileSize: 250*1024,
                callbacks:{
                    onImageUploadError: function(msg){
                        alert(msg + ' (250 KB)');
                    },
                    onImageUpload:function(files, editor, welEditable){
                        var img = files[0];
                        var data = new FormData();
                        data.append("file", img);
                        $("#img-upload-wait").show();
                        $.ajax({
                            url: '/api/blog/image',
                            data: data,
                            cache: false,
                            contentType: false,
                            processData: false,
                            type: 'POST',
                            success: function(data){
                                // callback(data)
                                // console.log(data);
                                $("#img-upload-wait").hide();
                                $('#content').summernote("insertImage", data);
                            }
                        });
                    },
                }
            });

            // CKEDITOR.replace('content');

            // ClassicEditor
            // .create( document.querySelector( '#content' ) )
            // .then( editor => {
            //     console.log( editor );
            // } )
            // .catch( error => {
            //     console.error( error );
            // } );

            $("#main_image").change(function(e){
                $("#img-preview").empty();
                let reader = new FileReader();
                let files = e.target.files;

                let img = document.createElement('img');
                img.width = "150";
                img.height = "100";

                reader.onload = function(){
                    img.src = reader.result;
                }

                reader.readAsDataURL(files[0])

                $("#img-preview").append(img);

            })
        });
    </script>
@endpush

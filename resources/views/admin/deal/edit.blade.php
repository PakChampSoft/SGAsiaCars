@extends('layouts.admin')

@section('content')
        <form class="form-row" method="POST" action="{{ route('deals.update', $deal->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group col-4">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{ $deal->title }}" id="title" class="form-control" required>
            </div>
            <div class="form-group col-4">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option {{ $deal->status == 0 ? 'selected' : '' }} value="0">Hide</option>
                    <option {{ $deal->status == 1 ? 'selected' : '' }} value="1">Show</option>
                </select>
            </div>
            <div class="form-group col-4">
                <label for="is_featured">Is Featured</label>
                <select name="is_featured" id="is_featured" class="form-control" required>
                    <option {{ $deal->status == 0 ? 'selected' : '' }} value="0">No</option>
                    <option {{ $deal->status == 1 ? 'selected' : '' }} value="1">Yes</option>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="icon">Icon</label>
                <input type="file" name="icon" id="icon" class="form-control-file">
                <div id="thumb" class="mt-2">
                    <img src="{{ Storage::url($deal->icon) }}" width="150" alt="icon">
                </div>
            </div>
            <div class="form-group col-6">
                <label for="picture">Picture</label>
                <input type="file" name="picture" id="picture" class="form-control-file">
                <div id="thumb2" class="mt-2">
                    <img src="{{ Storage::url($deal->picture) }}" width="150" alt="picture">
                </div>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Add" class="btn btn-sm btn-success float-right">
            </div>
        </form>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $("#icon").change(function(e){
            var thumbDiv = document.getElementById('thumb');
            var files = e.target.files;
            if(files.length > 0){
                console.log(files);
                var img = document.createElement('img');
                img.width = "150";
                img.height = "100";
                var reader = new FileReader();
                reader.onloadend = function(){
                    img.src = reader.result;
                }

                reader.readAsDataURL(files[0])
                $("#thumb").empty();
                thumbDiv.append(img);
            }else{
                $("#thumb").empty();
            }
        });

        $("#picture").change(function(e){
            var thumbDiv = document.getElementById('thumb2');
            var files = e.target.files;
            if(files.length > 0){
                console.log(files);
                var img = document.createElement('img');
                img.width = "150";
                img.height = "100";
                var reader = new FileReader();
                reader.onloadend = function(){
                    img.src = reader.result;
                }

                reader.readAsDataURL(files[0])
                $("#thumb2").empty();
                thumbDiv.append(img);
            }else{
                $("#thumb2").empty();
            }
        });

    });
</script>
@endpush

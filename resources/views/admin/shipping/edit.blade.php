@extends('layouts.admin')

@section('content')
        <form class="form-row" method="POST" action="{{ route('shippings.update', $shipping->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group col-12">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control-file">
                <img class="mt-2" src="{{ Storage::url($shipping->image) }}" alt="image" width="150" height="100">
            </div>
            <div class="form-group col-12">
                <label for="document">Document</label>
                <input type="file" name="document" id="document" class="form-control-file">
                <a href="{{ Storage::url($shipping->document) }}" download="shipping schedul.pdf" target="_blank" class="btn btn-sm btn-primary mt-2">Download File <i class="fas fa-arrow-circle-down"></i></a>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Update" class="btn btn-sm btn-success float-right">
            </div>
        </form>
@endsection

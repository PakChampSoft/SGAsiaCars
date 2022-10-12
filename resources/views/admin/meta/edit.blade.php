@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12 form-group">
        <label for="vehicle">Vehicles</label>
        <select name="vehicle" id="vehicle" class="form-control vehicle">
            <option value="" disabled>Select Vehicle</option>
            @forelse ($products as $producto)
            <option {{ $producto->id == $product->id ? 'selected' : '' }} value="{{ $producto->id }}">{{ $producto->ref_no }} {{ $producto->vcompany->name }} {{ $producto->vtype->name }}</option>
            @empty
            <option value="" disabled>No Vehicles Found</option>
            @endforelse
        </select>
    </div>
</div>

<form class="form-row" method="POST" action="{{ route('metas.update', $product->id) }}">
    @csrf
    @method('PUT')
    <div class="col-12 form-group">
        <label for="meta_title">Meta Title</label>
        <input type="text" class="form-control" value="{{ $product->meta_title }}" name="meta_title">
    </div>
    <div class="col-12 form-group">
        <label for="meta_description">Meta Description</label>
        <textarea name="meta_description" class="form-control" rows="5">{{ $product->meta_description }}</textarea>
    </div>
    <div class="col-12 form-group">
        <input type="submit" class="btn btn-primary" value="Update">
    </div>
</form>

@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $(".vehicle").change(function(){
                var pid = $(this).val();
                // alert(pid);
                var proute = "/admin/metas/"+pid+"/edit";

                window.location = proute;
            })
        });
    </script>
@endpush

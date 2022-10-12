@extends('layouts.admin')

@section('content')

<div class="row">
    {{-- <div class="col-12 mb-2">
        <a href="{{ route('deals.create') }}" class="btn btn-sm btn-success float-right">Add New</a>
    </div> --}}
    <div class="col-12 form-group">
        <label for="vehicle">Vehicles</label>
        <select name="vehicle" id="vehicle" class="form-control vehicle">
            <option value="" disabled selected>Select Vehicle</option>
            @forelse ($products as $product)
            <option value="{{ $product->id }}">{{ $product->ref_no }} {{ $product->vcompany->name }} {{ $product->vtype->name }}</option>
            @empty
            <option value="" disabled>No Vehicles Found</option>
            @endforelse
        </select>
        <p class="text-danger">Select a vehicle to view/edit meta data</p>
    </div>
</div>

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

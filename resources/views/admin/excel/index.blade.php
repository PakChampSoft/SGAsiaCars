@extends('layouts.admin')

@section('content')

    <form action="#" class="form-row" method="POST">
        @csrf
        <div class="form-group col-4">
            <label for="status">Vendor</label>
            <select name="status" id="status" class="form-control" required>
                <option value="" selected disabled>Select Vendor</option>
                @forelse ($vendors as $vendor)
                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                @empty
                    <option value="" disabled>No Vendors Found</option>
                @endforelse
            </select>
        </div>
        <div class="form-group col-4">
            <label for="status">Country</label>
            <select name="status" id="status" class="form-control" required>
                <option value="" selected disabled>Select Country</option>
                @forelse ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @empty
                    <option value="" disabled>No Countries Found</option>
                @endforelse
            </select>
        </div>
        <div class="form-group col-4">
            <label for="sheet">Excel Sheet</label>
            <input type="file" name="sheet" id="sheet" class="form-control-file" required>
        </div>
        <div class="form-group col-12">
            <input type="submit" class="btn btn-sm btn-success float-right">
        </div>
    </form>

@endsection

@extends('layouts.admin')

@section('content')
        <form class="form-row" method="POST" action="{{ route('countries.update', $country->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group col-12">
                <label for="name">Country Name</label>
                <input type="text" name="name" value="{{ $country->name }}" id="name" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Update" class="btn btn-sm btn-success float-right">
            </div>
        </form>
@endsection

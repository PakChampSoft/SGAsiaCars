@extends('layouts.admin')

@section('content')
        <form class="form-row" method="POST" action="{{ route('currencies.update', $currency->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group col-12">
                <label for="rate">Currency Rate ($1 = ? THB)</label>
                <input type="text" name="rate" id="rate" value="{{ $currency->rate }}" placeholder="Enter THB" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Update" class="btn btn-sm btn-success float-right">
            </div>
        </form>
@endsection

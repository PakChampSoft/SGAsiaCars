@extends('layouts.admin')

@section('content')
        <form class="form-row" method="POST" action="{{ route('ports.update', $port->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group col-6">
                <label for="country">Country</label>
                <select name="country" id="country" class="form-control" required>
                    <option value="" selected disabled>Select a Country</option>
                    @forelse ($countries as $country)
                        <option {{ $port->country->id == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                    @empty
                        <option value="" disabled>No Countries Found</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group col-6">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ $port->name }}" id="name" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label for="insurance">Insurance</label>
                <input type="text" name="insurance" value="{{ $port->insurance }}" id="insurance" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label for="inspection">Inspection</label>
                <input type="text" name="inspection" value="{{ $port->inspection }}" id="inspection" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label for="certificate">Certificate</label>
                <input type="text" name="certificate" value="{{ $port->certificate }}" id="certificate" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label for="warranty">Warranty</label>
                <input type="text" name="warranty" value="{{ $port->warranty }}" id="warranty" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label for="amount">Amount</label>
                <input type="text" name="amount" value="{{ $port->amount }}" id="amount" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Update" class="btn btn-sm btn-success float-right">
            </div>
        </form>
@endsection

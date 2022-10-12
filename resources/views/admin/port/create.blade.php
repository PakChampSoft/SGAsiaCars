@extends('layouts.admin')

@section('content')
        <form class="form-row" method="POST" action="{{ route('ports.store') }}">
            @csrf
            <div class="form-group col-6">
                <label for="country">Country</label>
                <select name="country" id="country" class="form-control" required>
                    <option value="" selected disabled>Select a Country</option>
                    @forelse ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @empty
                        <option value="" disabled>No Countries Found</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group col-6">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label for="insurance">Insurance</label>
                <input type="text" name="insurance" id="insurance" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label for="inspection">Inspection</label>
                <input type="text" name="inspection" id="inspection" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label for="certificate">Certificate</label>
                <input type="text" name="certificate" id="certificate" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label for="warranty">Warranty</label>
                <input type="text" name="warranty" id="warranty" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label for="amount">Amount</label>
                <input type="text" name="amount" id="amount" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Add" class="btn btn-sm btn-success float-right">
            </div>
        </form>
@endsection

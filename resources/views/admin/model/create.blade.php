@extends('layouts.admin')

@section('content')
        <form class="form-row" method="POST" action="{{ route('models.store') }}">
            @csrf
            <div class="form-group col-12">
                <label for="company">Company</label>
                <select name="company" id="company" class="form-control" required>
                    <option value="" selected disabled>Select Company</option>
                    @forelse ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @empty
                        <option value="" disabled>No Companies Found</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group col-12">
                <label for="name">Model Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Add" class="btn btn-sm btn-success float-right">
            </div>
        </form>
@endsection

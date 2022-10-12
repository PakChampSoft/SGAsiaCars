@extends('layouts.admin')

@section('content')
        <form class="form-row" method="POST" action="{{ route('colors.store') }}">
            @csrf
            <div class="form-group col-12">
                <label for="name">Color Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Add" class="btn btn-sm btn-success float-right">
            </div>
        </form>
@endsection

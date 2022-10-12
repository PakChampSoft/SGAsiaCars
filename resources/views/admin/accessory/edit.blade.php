@extends('layouts.admin')

@section('content')
        <form class="form-row" method="POST" action="{{ route('accessories.update', $accessory->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group col-12">
                <label for="name">Accessory Name</label>
                <input type="text" name="name" value="{{ $accessory->name }}" id="name" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Update" class="btn btn-sm btn-success float-right">
            </div>
        </form>
@endsection

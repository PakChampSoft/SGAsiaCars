@extends('layouts.admin')

@section('content')

    <form action="{{ route('api-clients.store') }}" class="form-row" method="POST">
        @csrf
        <div class="form-group col-6">
            <label for="client_name">Client Name</label>
            <input type="text" name="client_name" id="client_name" class="form-control" required>
        </div>
        <div class="form-group col-6">
            <label for="access_id">Access ID</label>
            <input type="text" name="access_id" id="access_id" class="form-control" required>
        </div>
        <div class="form-group col-6">
            <label for="access_key">Access Key</label>
            <input type="text" name="access_key" id="access_key" class="form-control" required>
        </div>
        <div class="form-group col-6">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="1">Allowed</option>
                <option value="0">Not Allowed</option>
            </select>
        </div>
        <div class="form-group col-12">
            <input type="submit" class="btn btn-sm btn-success float-right" value="Add">
        </div>
    </form>

@endsection

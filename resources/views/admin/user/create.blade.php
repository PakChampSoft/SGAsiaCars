@extends('layouts.admin')

@push('css')
    <style>
        .select2-selection__choice{background-color: #28a745 !important; color: white !important;}
        .select2-selection__choice__remove{color: #dc3545 !important;}
    </style>
@endpush

@section('content')
        <form class="form-row" method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="form-group col-12">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <label for="mobile">Mobile</label>
                <input type="text" name="mobile" id="mobile" class="form-control">
            </div>
            <div class="form-group col-12">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <label for="role">User Role</label>
                <select name="role" required id="role" class="form-control">
                    <option value="" disabled selected>Select Role</option>
                    @forelse ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @empty
                        <option value="" disabled>No Roles Found</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Add" class="btn btn-sm btn-success float-right">
            </div>
        </form>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Select Roles',
            closeOnSelect: false
        });
    });
</script>
@endpush

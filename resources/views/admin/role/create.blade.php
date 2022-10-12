@extends('layouts.admin')

@push('css')
    <style>
        .select2-selection__choice{background-color: #28a745 !important; color: white !important;}
        .select2-selection__choice__remove{color: #dc3545 !important;}
    </style>
@endpush

@section('content')
        <form class="form-row" method="POST" action="{{ route('roles.store') }}">
            @csrf
            <div class="form-group col-12">
                <label for="name">Role Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group col-12">
                <label for="permissions">Associate Permissions(Multiple Selection)</label>
                <select name="permissions[]" required id="permissions" class="form-control select2" multiple>
                    @forelse ($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                    @empty
                        <option value="" disabled>No Permissions Found</option>
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
            placeholder: 'Select Permissions',
            closeOnSelect: false
        });
    });
</script>
@endpush

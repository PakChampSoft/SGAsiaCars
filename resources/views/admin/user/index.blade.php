@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12 mb-2">
        <a href="{{ route('users.create') }}" class="btn btn-sm btn-success float-right">Add New</a>
        <a href="{{ route('users.vendors') }}" class="btn btn-sm btn-warning float-right mx-2">Vendors</a>
        <a href="{{ route('users.customers') }}" class="btn btn-sm btn-primary float-right">Customers</a>
        <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary float-right mr-2">All</a>
    </div>
    <div class="col-12 col-md-4 mb-2">
        <label for="filter_select">Select Period</label>
        <select class="form-control" id="filter_select">
            <option value="" disabled selected>Select</option>
            <option {{ request()->from == \Carbon\Carbon::today()->toDateString() ? 'selected' : '' }} value="{{ \Carbon\Carbon::today()->toDateString() }}">Today</option>
            <option {{ request()->from == \Carbon\Carbon::now()->startOfWeek()->toDateString() ? 'selected' : ''  }} value="{{ \Carbon\Carbon::now()->startOfWeek()->toDateString() }}">This Week</option>
            <option {{ request()->from == \Carbon\Carbon::now()->startOfMonth()->toDateString() ? 'selected' : ''  }} value="{{ \Carbon\Carbon::now()->startOfMonth()->toDateString() }}">This Month</option>
            <option {{ request()->from == "custom" ? 'selected' : ''  }} value="custom">Custom</option>
        </select>
    </div>
    <div class="col-12 mb-2 d-none" id="custom_dates">
        <form class="form-row" method="GET">
            <div class="form-group col-4">
                <label for="from">From</label>
                <input type="date" value="{{ request()->from }}" class="form-control" name="from">
            </div>
            <div class="form-group col-4">
                <label for="to">To</label>
                <input type="date" value="{{ request()->to }}" class="form-control" name="to">
            </div>
            <div class="form-group col-4 d-flex">
                <input type="submit" class="btn btn-primary align-self-end" value="Filter">
            </div>
        </form>
    </div>
    <div class="col-12">
        <table class="table table-bordered table-hover">
            <thead class="table-info">
                <tr>
                    <th>
                        <div class="form-check me-0">
                            <input class="form-check-input" type="checkbox" value="" id="checkAll">
                            <label class="form-check-label" for="checkAll"></label>
                        </div>
                    </th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Role(s)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->mobile }}</td>
                        <td>{{ $user->roles->pluck('name') }}</td>
                        <td class="d-flex">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            No Users Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $("#filter_select").change(function(){
                var selection = $(this).val();
                // console.log(selection);
                if(selection == "custom"){
                    $("#custom_dates").removeClass("d-none");
                }else{
                    $("#custom_dates").addClass("d-none");
                    let url_route = "{{ request()->url() }}" + "?from=" + "{{ \Carbon\Carbon::today()->toDateString() }}" + "&to=" + "{{ \Carbon\Carbon::today()->toDateString() }}";
                    // let url = url_route.replace(':from', selection);
                    // console.log(url);
                    window.location.href = url_route;
                }
            });
        });
    </script>
@endpush

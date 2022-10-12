@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12 mb-2">
        <a href="{{ route('clones.create') }}" class="btn btn-sm btn-success float-right">Add New</a>
    </div>
    <div class="col-12">
        <table class="table table-responsive table-bordered table-hover">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Company Name</th>
                    <th>Email</th>
                    <th>Domain</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Phone</th>
                    <th>Login</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clones as $clone)
                    <tr>
                        <td>{{ $clone->id }}</td>
                        <td>{{ $clone->name }}</td>
                        <td>{{ $clone->company_name }}</td>
                        <td>{{ $clone->email }}</td>
                        <td>{{ $clone->domain }}</td>
                        <td>{{ $clone->country }}</td>
                        <td>{{ $clone->city }}</td>
                        <td>{{ $clone->phone }}</td>
                        <td>{{ $clone->status }}</td>
                        <td><a href="#" class="btn btn-sm btn-warning">Login as Client</a></td>
                        <td class="">
                            {{-- <a href="{{ route('clones.edit', $clone->id) }}" class="btn btn-sm btn-warning mr-2">Edit</a> --}}
                            <form action="{{ route('clones.destroy', $clone->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            No Clones Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $clones->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection

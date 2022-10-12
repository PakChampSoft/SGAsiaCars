@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12 mb-2">
        <a href="{{ route('companies.create') }}" class="btn btn-sm btn-success float-right">Add New</a>
    </div>
    <div class="col-12">
        <table class="table table-bordered table-hover">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td class="d-flex">
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            No Companies Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $companies->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection

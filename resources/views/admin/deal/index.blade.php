@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12 mb-2">
        <a href="{{ route('deals.create') }}" class="btn btn-sm btn-success float-right">Add New</a>
    </div>
    <div class="col-12">
        <table class="table table-bordered table-hover">
            <thead class="table-info">
                <tr>
                    <th>Icon</th>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Is Featured</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($deals as $deal)
                    <tr>
                        <td>
                            <img src="{{ Storage::url($deal->icon) }}" width="150" height="100">
                        </td>
                        <td>
                            <img src="{{ Storage::url($deal->picture) }}" width="150" height="100">
                        </td>
                        <td>{{ $deal->title }}</td>
                        <td>{{ $deal->status == 1 ? "Active" : "Hidden" }}</td>
                        <td>{{ $deal->is_featured == 1 ? "Yes" : "No" }}</td>
                        <td class="d-flex">
                            <a href="{{ route('deals.edit', $deal->id) }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                            <form action="{{ route('deals.destroy', $deal->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            No Deals Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

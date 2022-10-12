@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12 mb-2">
        <a href="{{ route('accessories.create') }}" class="btn btn-sm btn-success float-right">Add New</a>
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
                @forelse ($accessories as $accessory)
                    <tr>
                        <td>{{ $accessory->id }}</td>
                        <td>{{ $accessory->name }}</td>
                        <td class="d-flex">
                            <a href="{{ route('accessories.edit', $accessory->id) }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                            <form action="{{ route('accessories.destroy', $accessory->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            No Types Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $accessories->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection

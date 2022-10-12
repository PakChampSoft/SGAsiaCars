@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12 mb-2">
        <a href="{{ route('ports.create') }}" class="btn btn-sm btn-success float-right">Add New</a>
    </div>
    <div class="col-12">
        <table class="table table-bordered table-hover">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Country</th>
                    <th>Name</th>
                    <th>Insurance</th>
                    <th>Inspection</th>
                    <th>Certificate</th>
                    <th>Warranty</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ports as $port)
                    <tr>
                        <td>{{ $port->id }}</td>
                        <td>{{ $port->country->name }}</td>
                        <td>{{ $port->name }}</td>
                        <td>{{ $port->insurance }}</td>
                        <td>{{ $port->inspection }}</td>
                        <td>{{ $port->certificate }}</td>
                        <td>{{ $port->warranty }}</td>
                        <td>{{ $port->amount }}</td>
                        <td class="d-flex">
                            <a href="{{ route('ports.edit', $port->id) }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                            <form action="{{ route('ports.destroy', $port->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            No ports Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $ports->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection

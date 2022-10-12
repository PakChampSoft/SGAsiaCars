@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12 mb-2">
        <a href="{{ route('models.create') }}" class="btn btn-sm btn-success float-right">Add New</a>
    </div>
    <div class="col-12">
        <table class="table table-bordered table-hover">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Company</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($models as $model)
                    <tr>
                        <td>{{ $model->id }}</td>
                        <td>{{ $model->company->name }}</td>
                        <td>{{ $model->name }}</td>
                        <td class="d-flex">
                            <a href="{{ route('models.edit', $model->id) }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                            <form action="{{ route('models.destroy', $model->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            No Models Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $models->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection

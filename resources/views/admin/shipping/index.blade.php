@extends('layouts.admin')

@section('content')

<div class="row">
    {{-- <div class="col-12 mb-2">
        <a href="{{ route('permissions.create') }}" class="btn btn-sm btn-success float-right">Add New</a>
    </div> --}}
    <div class="col-12">
        <table class="table table-bordered table-hover">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Document</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($shippings as $shipping)
                    <tr>
                        <td>{{ $shipping->id }}</td>
                        <td>
                            <img src="{{ Storage::url($shipping->image) }}" width="150" height="100">
                        </td>
                        <td class="align-middle"><a href="{{ Storage::url($shipping->document) }}" download="shipping schedul.pdf" target="_blank" class="btn btn-sm btn-primary">Download File <i class="fas fa-arrow-circle-down"></i></a></td>
                        <td class="align-middle">
                            <a href="{{ route('shippings.edit', $shipping->id) }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                            {{-- <form action="{{ route('shippings.destroy', $shipping->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                            </form> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            No Shippings Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

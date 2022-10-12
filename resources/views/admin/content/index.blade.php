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
                    <th>Page Title</th>
                    <th>Page Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contents as $content)
                    <tr>
                        <td>{{ $content->id }}</td>
                        <td>{{ $content->pagetitle }}</td>
                        <td>{{ $content->pagename }}</td>
                        <td class="d-flex">
                            <a href="{{ route('contents.edit', $content->id) }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                            {{-- <form action="{{ route('contents.destroy', $content->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                            </form> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            No Contents Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

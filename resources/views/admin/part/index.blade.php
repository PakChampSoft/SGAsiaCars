@extends('layouts.admin')

@section('content')

<form class="form-row">
    <div class="form-group col-4 offset-4">
        <label for="ref_no">Search By Ref No.</label>
        <input type="text" name="ref_no" id="ref_no" class="form-control">
    </div>
    <div class="w-100"></div>
    <div class="form-group col-4 offset-4">
        <input type="submit" class="btn btn-sm btn-dark btn-block" value="Search">
    </div>
</form>
<div class="row">
    <div class="col-12 mb-2">
        <a href="{{ route('parts.create') }}" class="btn btn-sm btn-success float-right">Add New</a>
    </div>
    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Sold</th>
                    <th>Photo</th>
                    <th>Ref No|Engine Size|Genuine Parts No.</th>
                    <th>Maker/Company</th>
                    <th>From Year</th>
                    <th>To Year</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($autoparts as $part)
                    <tr>
                        <td>{{ $part->id }}</td>
                        <td>{!! $part->sold == 1 ? '<a class="btn btn-sm btn-success" href="#">Sold</a>' : '<a class="btn btn-sm btn-warning" href="#">Unsold</a>' !!}</td>
                        <td>
                            <img src="{{ asset('images/vigo.jpg') }}" width="150" height="100">
                        </td>
                        <td>{{ $part->ref_no . '|' . $part->engine_size . '|' . $part->genuine_parts_no }}</td>
                        <td>{{ $part->apcompany->name }}</td>
                        <td>{{ $part->from_year }}</td>
                        <td>{{ $part->to_year }}</td>
                        <td class="d-flex">
                            <a href="{{ route('parts.edit', $part->id) }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                            <form action="{{ route('parts.destroy', $part->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                            </form>
                            <a href="#" class="btn btn-sm btn-primary ml-2">Preview</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            No Autoparts Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $autoparts->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection

@extends('layouts.admin')

@section('content')



<div class="row">
    <div class="col-12 mb-2">
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
                    <th>Ref#</th>
                    <th>Image</th>
                    <th>Company</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($quotes as $quote)
                    <tr>
                        <td>{{ $quote->product->ref_no ?? '' }}</td>
                        <td>
                            <img src="{{ asset($quote->product->main_image_name ?? '') }}" alt="img" width="150" height="100">
                        </td>
                        <td>{{ $quote->product->vcompany->name ?? '' }}</td>
                        <td>{{ $quote->product->vtype->name ?? '' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            No Quotes Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $quotes->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection

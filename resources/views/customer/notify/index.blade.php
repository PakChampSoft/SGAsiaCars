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
                    <th>Product Ref#</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Company</th>
                    <th>Type</th>
                    <th>Notified</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($notifications as $notification)
                    <tr>
                        <td>{{ $notification->product->ref_no ?? '' }}</td>
                        <td>{{ $notification->product->sold == 0 ? 'Availble' : ($notification->product->sold == 3 ? 'Hold' : 'Not Available') }}</td>
                        <td>
                            <img src="{{ asset($notification->product->main_image_name ?? '') }}" alt="img" width="150" height="100">
                        </td>
                        <td>{{ $notification->product->vcompany->name ?? '' }}</td>
                        <td>{{ $notification->product->vtype->name ?? '' }}</td>
                        <td class="{{ $notification->notified == 1 ? 'bg-success' : 'bg-warning' }}">{{ $notification->notified == 1 ? 'Yes' : 'No' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            No Notifications Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $notifications->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection

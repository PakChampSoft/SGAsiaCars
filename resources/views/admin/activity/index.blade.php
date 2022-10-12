@extends('layouts.admin')

@section('content')

<form action="{{ route('user-activities.index') }}" class="form-row">
    <div class="form-group col-4">
        <label for="from">From</label>
        <input type="date" class="form-control" name="from" value="{{ request()->from }}" placeholder="From">
    </div>
    <div class="form-group col-4">
        <label for="to">To</label>
        <input type="date" class="form-control" name="to" value="{{ request()->to }}" placeholder="To">
    </div>
    <div class="form-group col-4 d-flex">
        <input type="submit" class="btn btn-secondary align-self-end" value="Filter">
    </div>
</form>

<div class="row">
    <div class="col-12">
        <table class="table table-bordered table-hover">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>IP Address</th>
                    <th>Date/Time</th>
                    <th>Activity</th>
                    <th>Module</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($userActivities as $activity)
                    <tr>
                        <td>{{ $activity->id }}</td>
                        <td><a href="{{ route('user-activities.show', array_merge(request()->query(), ['user_activity' => $activity->user_id])) }}">{{ $activity->user_id }}</a></td>
                        <td>{{ $activity->ip_address }}</td>
                        <td>{{ $activity->created_at->format('d/m/y - h:i:s') }}</td>
                        <td>{{ $activity->activity }}</td>
                        <td>{{ $activity->module }}</td>
                        <td>{{ $activity->activity_details }}</td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            No Activities Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $userActivities->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection

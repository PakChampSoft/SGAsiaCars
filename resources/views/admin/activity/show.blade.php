@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12 mb-2">
        <a href="{{ route('user-activities.report', array_merge(request()->query(), ['id' => $userActivities[0]->user_id])) }}" class="btn btn-primary btn-sm float-right">Download PDF</a>
    </div>
    <div class="col-12">
        <table class="table table-bordered table-hover">
            <thead class="table-info">
                <tr>
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
                        <td>{{ $activity->user_id }}</td>
                        <td>{{ $activity->ip_address }}</td>
                        <td>{{ $activity->created_at->format('d/m/y H:i:s') }}</td>
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
    </div>
</div>

@endsection

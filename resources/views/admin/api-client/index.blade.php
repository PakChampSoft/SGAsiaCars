@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12 mb-2">
        <a href="{{ route('api-clients.create') }}" class="btn btn-sm btn-success float-right">Add New</a>
    </div>
    <div class="col-12">
        <table class="table table-bordered table-hover">
            <thead class="table-info">
                <tr>
                    <th>Client Name</th>
                    <th>Access ID</th>
                    <th>Access Key</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clients as $client)
                    <tr>
                        <td>{{ $client->client_name }}</td>
                        <td>{{ $client->access_id }}</td>
                        <td>{{ $client->access_key }}</td>
                        <td>
                            <a href="{{ route('api-clients.status', $client->id) }}" class="btn btn-sm btn-primary mr-2">{{ $client->status == 1 ? 'Approved' : 'Rejected' }}</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            No Permissions Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

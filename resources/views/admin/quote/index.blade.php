@extends('layouts.admin')

@section('content')



<div class="row">
    <div class="col-12 col-md-4 mb-2">
        <label for="filter_select">Select Period</label>
        <select class="form-control" id="filter_select">
            <option value="" disabled selected>Select</option>
            <option {{ request()->from == \Carbon\Carbon::today()->toDateString() ? 'selected' : '' }} value="{{ \Carbon\Carbon::today()->toDateString() }}">Today</option>
            <option {{ request()->from == \Carbon\Carbon::now()->startOfWeek()->toDateString() ? 'selected' : ''  }} value="{{ \Carbon\Carbon::now()->startOfWeek()->toDateString() }}">This Week</option>
            <option {{ request()->from == \Carbon\Carbon::now()->startOfMonth()->toDateString() ? 'selected' : ''  }} value="{{ \Carbon\Carbon::now()->startOfMonth()->toDateString() }}">This Month</option>
            <option {{ request()->from == "custom" ? 'selected' : ''  }} value="custom">Custom</option>
        </select>
    </div>
    <div class="col-12 mb-2 d-none" id="custom_dates">
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
                    <th>ID</th>
                    <th>Image</th>
                    <th>Ref#</th>
                    <th>Company</th>
                    <th>Type</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($quotes as $quote)
                    <tr>
                        <td>{{ $quote->id }}</td>
                        <td>
                            <img src="{{ asset($quote->product->main_image_name ?? '') }}" alt="img" width="150" height="100">
                        </td>
                        <td>{{ $quote->product->ref_no ?? '' }}</td>
                        <td>{{ $quote->product->vcompany->name ?? '' }}</td>
                        <td>{{ $quote->product->vtype->name ?? '' }}</td>
                        <td>{{ $quote->fullname ?? '' }}</td>
                        <td>{{ $quote->email ?? '' }}</td>
                        <td>{{ $quote->tel ?? '' }}</td>
                        <td>{{ $quote->address ?? '' }}</td>
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

@push('js')
    <script>
        $(document).ready(function(){
            $("#filter_select").change(function(){
                var selection = $(this).val();
                // console.log(selection);
                if(selection == "custom"){
                    $("#custom_dates").removeClass("d-none");
                }else{
                    $("#custom_dates").addClass("d-none");
                    let url_route = "{{ request()->url() }}" + "?from=" + "{{ \Carbon\Carbon::today()->toDateString() }}" + "&to=" + "{{ \Carbon\Carbon::today()->toDateString() }}";
                    // let url = url_route.replace(':from', selection);
                    // console.log(url);
                    window.location.href = url_route;
                }
            });
        });
    </script>
@endpush

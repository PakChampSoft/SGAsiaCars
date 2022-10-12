@extends('layouts.main')

@section('content')
    <div class="w-5/12 mx-auto my-4">
        <div class="bg-blue-100 rounded-md p-4">
            <h1 class="text-2xl font-bold dark-blue-text">Pre-Order</h1>
            <hr class="border-blue-900">
            <form class="grid grid-cols-1 mt-4 gap-y-2" method="POST" action="{{ route('pre-order.store') }}">
                @csrf
                {{-- <div class="frm-grp space-y-1"> --}}
                    {{-- <label for="name">Ref #</label> --}}
                    <input type="hidden" value="{{ request()->product_id }}" class="w-full text-sm rounded-md bg-gray-200" name="product_id" id="product_id">
                {{-- </div> --}}
                <div class="frm-grp space-y-1">
                    <label for="email">Email</label>
                    <input type="email" class="w-full text-sm rounded-md" name="email" id="email" placeholder="Email Address" required>
                </div>
                <div class="frm-grp space-y-1">
                    <label for="phone">Phone</label>
                    <input type="text" class="w-full text-sm rounded-md" name="phone" id="phone" placeholder="Phone Number">
                </div>
                <div class="frm-grp space-y-1">
                    <button type="submit" class="w-full text-sm dark-blue-bg text-white py-2 rounded-md">Preorder Now</button>
                </div>
            </form>
        </div>
    </div>
    @include('includes.contact-info')
@endsection

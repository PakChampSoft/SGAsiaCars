@extends('layouts.main')
@push('title')
    <title> {{$pagedata->seo_title}}</title>
@endpush
@push('meta')
<meta name="description" content="{{ $pagedata? $pagedata->meta_description: "" }}">
<meta name="keywords" content="{{ $pagedata? $pagedata->meta_keywords: "" }}">
@endpush

@section('content')
    <div class="w-5/12 mx-auto my-4">
        <div class="bg-blue-100 rounded-md p-4">
            <h1 class="text-2xl font-bold dark-blue-text">Contact Us</h1>
            <hr class="border-blue-900">
            <form class="grid grid-cols-1 mt-4 gap-y-2" action="{{ route('landing.contact') }}" method="POST">
                @csrf
                <div class="frm-grp space-y-1">
                    <label for="name">Name</label>
                    <input type="text" class="w-full text-sm rounded-md" name="name" id="name" placeholder="Full Name" required>
                </div>
                <div class="frm-grp space-y-1">
                    <label for="email">Email</label>
                    <input type="email" class="w-full text-sm rounded-md" name="email" id="email" placeholder="Email Address" required>
                </div>
                <div class="frm-grp space-y-1">
                    <label for="phone">Phone</label>
                    <input type="text" class="w-full text-sm rounded-md" name="phone" id="phone" placeholder="Phone Number" required>
                </div>
                <div class="frm-grp space-y-1">
                    <label for="country">Country</label>
                    <select name="country" class="w-full text-sm rounded-md" id="country" required>
                        <option value="">Select</option>
                        @forelse ($countries as $country)
                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                        @empty
                            <option value="">No Country Found</option>
                        @endforelse
                    </select>
                </div>
                <div class="frm-grp space-y-1">
                    <label for="subject">Subject</label>
                    <input type="text" class="w-full text-sm rounded-md" name="subject" id="subject" placeholder="Subject" required>
                </div>
                <div class="frm-grp space-y-1">
                    <label for="message">Message</label>
                    <textarea name="message" class="w-full text-sm rounded-md" id="message" rows="5" required></textarea>
                </div>
                <div class="frm-grp space-y-1">
                    <button type="submit" class="w-full text-sm dark-blue-bg text-white py-2 rounded-md">SEND MESSAGE <i class="las la-paper-plane"></i></button>
                </div>
            </form>
        </div>
    </div>
    @include('includes.contact-info')
@endsection

@extends('layouts.main')
@push('title')
    <title> {{$blog->title}}</title>
@endpush
@push('meta')
<meta name="description" content="{{ $blog? $blog->meta_description: "" }}">
<meta name="keywords" content="{{ $blog? $blog->meta_keywords: "" }}">
@endpush
@push('style')
    <style>
        p>image{
            display: flex;
            align-items: center;
            justify-content: center;
        }

        i{
            font-style: italic !important;
        }

        i>b{
            font-style: italic !important;
        }

        i>span>b{
            font-style: italic !important;
        }
    </style>
@endpush

@section('content')
    <div class="w-10/12 mx-auto my-4 space-y-2">
        <div class="flex items-center justify-center">
            <img src="{{ Storage::url($blog->main_image) }}" alt="blog image">
        </div>
        <div>
            <h1 class="text-2xl font-bold">{{ $blog->title }}</h1>
            <h2><b class="dark-blue-text">Author</b> {{ $blog->user->name }} <b class="dark-blue-text">Date:</b> {{ $blog->created_at->format('M d, Y') }}</h2>
        </div>
        <hr>
        <article class="prose max-w-none">
            {!! $blog->content !!}
        </article>
    </div>
@endsection

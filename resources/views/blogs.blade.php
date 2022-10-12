@extends('layouts.main')

@push('title')
    <title> {{$pagedata->seo_title}}</title>
@endpush
@push('meta')
<meta name="description" content="{{ $pagedata? $pagedata->meta_description: "" }}">
<meta name="keywords" content="{{ $pagedata? $pagedata->meta_keywords: "" }}">
@endpush

@section('content')
    <div class="mx-8 my-4">
        <div class="grid grid-cols-12 gap-2">
            {{-- blogs area --}}
            <div class="col-span-10 space-y-4">
                @foreach ($blogs as $blog)
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-4">
                        <img src="{{ Storage::url($blog->main_image) }}" alt="blog image" class="w-full h-40">
                    </div>
                    <div class="col-span-8 space-y-2">
                        <div>
                            <a href="{{ route('landing.blog', $blog->slug) }}" class="text-xl font-bold hover:underline line-clamp-2" title="{{ $blog->title ?? '' }}">{{ $blog->title }}</a>
                        </div>
                        <div>
                            <p><b class="dark-blue-text">Author:</b> {{ $blog->user->name }} <b class="dark-blue-text">Date:</b> {{ $blog->created_at->format('M d, Y') }} <b class="dark-blue-text">Views:</b> {{ $blog->views }}</p>
                        </div>
                        <div>
                            <p class="line-clamp-4">{{ $blog->meta_description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="my-2">
                    {{ $blogs->links() }}
                </div>
            </div>
            {{-- news area --}}
            <div class="col-span-2 border h-auto">
                <h1 class="dark-blue-bg text-white font-bold text-sm text-center p-2">SG ASIA CARS NEWS</h1>
                @foreach ($latestBlogs as $blog)
                <div class="grid grid-cols-3 gap-1 my-2 px-1">
                    <div class="col-span-1">
                        <img src="{{ Storage::url($blog->main_image) }}" alt="blog image" class="w-full">
                    </div>
                    <div class="col-span-2">
                        <div>
                            <a href="{{ route('landing.blog', $blog->slug) }}" class="text-sm font-bold hover:underline line-clamp-2" title="{{ $blog->title ?? '' }}">{{ $blog->title }}</a>
                        </div>
                        <div>
                            <p class="dark-blue-text text-xs">{{ $blog->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

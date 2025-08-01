@extends('frontend.layouts.app')

@section('title', 'News - Siddique Memorial School And College, Rangpur')

@section('content')
    <!-- Page Header -->
    <section class="page-header bg-primary text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold">Latest News</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">News</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- News Content -->
    <section class="news-content py-5">
        <div class="container">
            <div class="row">
                @forelse($news as $item)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card news-card h-100">
                            <img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://images.unsplash.com/photo-1509062522246-3755977927d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}"
                                class="card-img-top" alt="{{ $item->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->title }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($item->description, 100) }}</p>
                                <a href="{{ route('news.detail', $item->slug) }}" class="btn btn-outline-primary">Read
                                    More</a>
                            </div>
                            <div class="card-footer text-muted">
                                <small>{{ $item->created_at->format('M d, Y') }}</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center">
                            <p class="text-muted">No news available at the moment.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($news->hasPages())
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="News pagination">
                            {{ $news->links() }}
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

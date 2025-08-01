@extends('frontend.layouts.app')

@section('title', $news->title . ' - Siddique Memorial School And College, Rangpur')

@section('content')
    <!-- Page Header -->
    <section class="page-header bg-primary text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold">News Detail</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-white">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('frontend.news') }}" class="text-white">News</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- News Detail Content -->
    <section class="news-detail-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        @if ($news->image_path)
                            <img src="{{ asset('storage/' . $news->image_path) }}" class="card-img-top"
                                alt="{{ $news->title }}">
                        @endif
                        <div class="card-body">
                            <h2 class="card-title">{{ $news->title }}</h2>
                            <p class="text-muted mb-3">
                                <i class="fas fa-calendar me-2"></i>
                                Published on {{ $news->created_at->format('F d, Y') }}
                            </p>
                            <div class="news-content">
                                {!! $news->description !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Related News</h5>
                        </div>
                        <div class="card-body">
                            @forelse($relatedNews as $related)
                                <div class="related-news-item mb-3">
                                    <h6><a href="{{ route('frontend.news.detail', $related->slug) }}"
                                            class="text-decoration-none">{{ $related->title }}</a></h6>
                                    <small class="text-muted">{{ $related->created_at->format('M d, Y') }}</small>
                                </div>
                            @empty
                                <p class="text-muted">No related news available.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('frontend.layouts.app')

@section('title', 'Photo Gallery - Siddique Memorial School And College, Rangpur')

@section('content')
    <!-- Page Header -->
    <section class="page-header bg-primary text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold">Photo Gallery</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-white">Home</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Gallery</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Content -->
    <section class="gallery-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title text-center mb-5">School Life in Pictures</h2>
                    <p class="lead text-center text-muted mb-5">Explore our vibrant school community through these memorable
                        moments captured in our photo gallery.</p>
                </div>
            </div>
            <div class="row">
                @forelse($gallery as $item)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="gallery-item">
                            <img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://images.unsplash.com/photo-1509062522246-3755977927d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}"
                                alt="{{ $item->title }}" class="img-fluid rounded">
                            <div class="gallery-overlay">
                                <h6 class="text-white">{{ $item->title }}</h6>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center">
                            <p class="text-muted">No gallery items available at the moment.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($gallery->hasPages())
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Gallery pagination">
                            {{ $gallery->links() }}
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@extends('frontend.layouts.app')

@section('title', 'Our Teachers - Siddique Memorial School And College, Rangpur')

@section('content')
    <!-- Page Header -->
    <section class="page-header bg-primary text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold">Our Teachers</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-white">Home</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Teachers</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Teachers Content -->
    <section class="teachers-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title text-center mb-5">Meet Our Faculty</h2>
                    <p class="lead text-center text-muted mb-5">Our dedicated team of experienced and qualified teachers is
                        committed to providing quality education and nurturing the potential of every student.</p>
                </div>
            </div>
            <div class="row">
                @forelse($teachers as $teacher)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card teacher-card text-center h-100">
                            <img src="{{ $teacher->image_path ? asset('storage/' . $teacher->image_path) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80' }}"
                                class="card-img-top" alt="{{ $teacher->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $teacher->name }}</h5>
                                <p class="card-text text-muted">{{ $teacher->designation }}</p>
                                <p class="card-text"><small class="text-muted">{{ $teacher->department }}</small></p>
                                @if ($teacher->email)
                                    <p class="card-text"><small class="text-muted">{{ $teacher->email }}</small></p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center">
                            <p class="text-muted">No teachers available at the moment.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($teachers->hasPages())
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Teachers pagination">
                            {{ $teachers->links() }}
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

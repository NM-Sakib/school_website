@extends('frontend.layouts.app')

@section('title', 'Notices - Siddique Memorial School And College, Rangpur')

@section('content')
    <!-- Page Header -->
    <section class="page-header bg-primary text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold">Notices</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Notices</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Notices Content -->
    <section class="notices-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title text-center mb-5">Important Notices</h2>
                    <p class="lead text-center text-muted mb-5">Stay updated with the latest announcements and important
                        information from our school.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="notices-list">
                        @forelse($notices as $notice)
                            <div class="notice-item border-bottom pb-3 mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">{{ $notice->title }}</h6>
                                        <p class="text-muted mb-2">{{ Str::limit($notice->description, 200) }}</p>
                                        @if ($notice->file_path)
                                            <a href="{{ asset('storage/' . $notice->file_path) }}"
                                                class="btn btn-sm btn-outline-primary" target="_blank">
                                                <i class="fas fa-download me-1"></i>Download Notice
                                            </a>
                                        @endif
                                    </div>
                                    <small class="text-muted">{{ $notice->created_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                        @empty
                            <div class="text-center">
                                <p class="text-muted">No notices available at the moment.</p>
                            </div>
                        @endforelse
                    </div>

                    @if ($notices->hasPages())
                        <div class="row">
                            <div class="col-12">
                                <nav aria-label="Notices pagination">
                                    {{ $notices->links() }}
                                </nav>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

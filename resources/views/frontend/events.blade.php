@extends('frontend.layouts.app')

@section('title', 'Events - Siddique Memorial School And College, Rangpur')

@section('content')
    <!-- Page Header -->
    <section class="page-header bg-primary text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold">Events</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Events</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Content -->
    <section class="events-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title text-center mb-5">School Events</h2>
                    <p class="lead text-center text-muted mb-5">Discover the exciting events and activities that make our
                        school community vibrant and engaging.</p>
                </div>
            </div>
            <div class="row">
                @forelse($events as $event)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card event-card h-100">
                            <div class="card-body">
                                <div class="event-date bg-primary text-white text-center p-3 mb-3">
                                    <h4 class="mb-0">{{ $event->event_date->format('d') }}</h4>
                                    <small>{{ $event->event_date->format('M Y') }}</small>
                                </div>
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($event->description, 150) }}</p>
                                <div class="event-meta">
                                    <i class="fas fa-calendar text-primary me-2"></i>
                                    <span class="text-muted">{{ $event->event_date->format('F d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center">
                            <p class="text-muted">No events available at the moment.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($events->hasPages())
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Events pagination">
                            {{ $events->links() }}
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

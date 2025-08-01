@extends('frontend.layouts.app')

@section('title', 'Home - Siddique Memorial School And College, Rangpur')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section position-relative">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img
                        src="{{ asset('assets/images/hero.png') }}"
                        class="d-block w-100" alt="School Building">
                    <div class="carousel-caption">
                        <h1 class="display-4 fw-bold">Welcome to Siddique Memorial School And College</h1>
                        <p class="lead">Education | Morality | Discipline</p>
                        <a href="{{ route('about') }}" class="btn btn-primary btn-lg">Learn More</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                        class="d-block w-100" alt="Library">
                    <div class="carousel-caption">
                        <h1 class="display-4 fw-bold">Excellence in Education</h1>
                        <p class="lead">Providing quality education since 1978</p>
                        <a href="{{ route('academics') }}" class="btn btn-primary btn-lg">Our Academics</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2032&q=80"
                        class="d-block w-100" alt="Students">
                    <div class="carousel-caption">
                        <h1 class="display-4 fw-bold">Building Future Leaders</h1>
                        <p class="lead">Nurturing talent and character</p>
                        <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">Contact Us</a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>

    <!-- Welcome Section -->
    <section class="welcome-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-title">Welcome to Siddique Memorial School And College</h2>
                    <p class="lead text-muted">The history of Siddique Memorial School And College can be traced back to
                        1978 when the foundation stone was laid for the education of children in Rangpur. Our main purpose
                        is to meet the challenges of the future, building up confident and successful students by providing
                        education with the latest knowledge, information, communication skills and a vision with a blend of
                        Bangladeshi cultural heritage.</p>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="feature-item">
                                <i class="fas fa-graduation-cap text-primary mb-3"></i>
                                <h5>Quality Education</h5>
                                <p class="text-muted">Providing excellent academic standards</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-item">
                                <i class="fas fa-users text-primary mb-3"></i>
                                <h5>Experienced Teachers</h5>
                                <p class="text-muted">Dedicated and qualified faculty</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('about') }}" class="btn btn-outline-primary mt-3">Read More</a>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110cfe1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                        alt="School Building" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Stats -->
    <section class="stats-section bg-primary text-white py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-3">
                    <div class="stat-item">
                        <i class="fas fa-users fa-3x mb-3"></i>
                        <h3 class="fw-bold">1500+</h3>
                        <p class="mb-0">Students</p>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="stat-item">
                        <i class="fas fa-chalkboard-teacher fa-3x mb-3"></i>
                        <h3 class="fw-bold">50+</h3>
                        <p class="mb-0">Teachers</p>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="stat-item">
                        <i class="fas fa-trophy fa-3x mb-3"></i>
                        <h3 class="fw-bold">25+</h3>
                        <p class="mb-0">Years</p>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="stat-item">
                        <i class="fas fa-medal fa-3x mb-3"></i>
                        <h3 class="fw-bold">95%</h3>
                        <p class="mb-0">Success Rate</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News -->
    <section class="news-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title text-center mb-5">Latest News</h2>
                </div>
            </div>
            <div class="row">
                @forelse($latestNews as $news)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card news-card h-100">
                            <img src="{{ $news->image_path ? asset('storage/' . $news->image_path) : 'https://images.unsplash.com/photo-1509062522246-3755977927d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}"
                                class="card-img-top" alt="{{ $news->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $news->title }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($news->description, 100) }}</p>
                                <a href="{{ route('news.detail', $news->slug) }}" class="btn btn-outline-primary">Read
                                    More</a>
                            </div>
                            <div class="card-footer text-muted">
                                <small>{{ $news->created_at->format('M d, Y') }}</small>
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
            <div class="text-center mt-4">
                <a href="{{ route('news') }}" class="btn btn-primary">View All News</a>
            </div>
        </div>
    </section>

    <!-- Upcoming Events -->
    <section class="events-section bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title text-center mb-5">Upcoming Events</h2>
                </div>
            </div>
            <div class="row">
                @forelse($upcomingEvents as $event)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card event-card h-100">
                            <div class="card-body">
                                <div class="event-date bg-primary text-white text-center p-3 mb-3">
                                    <h4 class="mb-0">{{ $event->event_date->format('d') }}</h4>
                                    <small>{{ $event->event_date->format('M Y') }}</small>
                                </div>
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($event->description, 100) }}</p>
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
                            <p class="text-muted">No upcoming events at the moment.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('events') }}" class="btn btn-primary">View All Events</a>
            </div>
        </div>
    </section>

    <!-- Latest Notices -->
    <section class="notices-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="section-title mb-4">Latest Notices</h2>
                    <div class="notices-list">
                        @forelse($latestNotices as $notice)
                            <div class="notice-item border-bottom pb-3 mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">{{ $notice->title }}</h6>
                                        <p class="text-muted mb-2">{{ Str::limit($notice->description, 150) }}</p>
                                        @if ($notice->file_path)
                                            <a href="{{ asset('storage/' . $notice->file_path) }}"
                                                class="btn btn-sm btn-outline-primary" target="_blank">
                                                <i class="fas fa-download me-1"></i>Download
                                            </a>
                                        @endif
                                    </div>
                                    <small class="text-muted">{{ $notice->created_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No notices available at the moment.</p>
                        @endforelse
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('notices') }}" class="btn btn-outline-primary">View All Notices</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-clock me-2"></i>School Hours</h5>
                        </div>
                        <div class="card-body">
                            <div class="school-hours">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Monday - Friday</span>
                                    <span>8:00 AM - 3:00 PM</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Saturday</span>
                                    <span>8:00 AM - 12:00 PM</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Sunday</span>
                                    <span>Closed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Preview -->
    <section class="gallery-section bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title text-center mb-5">Photo Gallery</h2>
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
            <div class="text-center mt-4">
                <a href="{{ route('gallery') }}" class="btn btn-primary">View All Photos</a>
            </div>
        </div>
    </section>

    <!-- Teachers Preview -->
    <section class="teachers-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title text-center mb-5">Our Teachers</h2>
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
            <div class="text-center mt-4">
                <a href="{{ route('teachers') }}" class="btn btn-primary">View All Teachers</a>
            </div>
        </div>
    </section>
@endsection

@if ($popupNotice)
    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Show popup notice
                const popup = document.createElement('div');
                popup.className = 'popup-notice';
                popup.innerHTML = `
                <div class="popup-content">
                    <div class="popup-header">
                        <h5>Important Notice</h5>
                        <button type="button" class="btn-close" onclick="this.parentElement.parentElement.parentElement.remove()"></button>
                    </div>
                    <div class="popup-body">
                        <h6>{{ $popupNotice->title }}</h6>
                        <p>{{ $popupNotice->description }}</p>
                    </div>
                </div>
            `;
                document.body.appendChild(popup);
            });
        </script>
    @endsection
@endif
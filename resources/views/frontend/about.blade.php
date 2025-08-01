@extends('frontend.layouts.app')

@section('title', 'About Us - Siddique Memorial School And College, Rangpur')

@section('content')
    <!-- Page Header -->
    <section class="page-header bg-primary text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold">About Us</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">About</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- About Content -->
    <section class="about-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="section-title">Our History</h2>
                    <p class="lead text-muted">The history of Siddique Memorial School And College can be traced back to
                        1978 when the foundation stone was laid for the education of children in Rangpur. Our main purpose
                        is to meet the challenges of the future, building up confident and successful students by providing
                        education with the latest knowledge, information, communication skills and a vision with a blend of
                        Bangladeshi cultural heritage.</p>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>1978 - Foundation</h5>
                            <p class="text-muted">The institution started functioning from Nursery to class VI.</p>
                        </div>
                        <div class="col-md-6">
                            <h5>1980 - School Extension</h5>
                            <p class="text-muted">Extended up to class X and students first appeared in S.S.C examination.
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5>1981 - College Branch</h5>
                            <p class="text-muted">Separate branch for college was opened and students appeared in H.S.C
                                examination.</p>
                        </div>
                        <div class="col-md-6">
                            <h5>1995 - Degree Course</h5>
                            <p class="text-muted">Degree (pass) Course started under National University of Bangladesh.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Quick Facts</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <i class="fas fa-calendar text-primary me-2"></i>
                                    <strong>Established:</strong> 1978
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <strong>Location:</strong> Rangpur, Bangladesh
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-users text-primary me-2"></i>
                                    <strong>Students:</strong> 1500+
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-chalkboard-teacher text-primary me-2"></i>
                                    <strong>Teachers:</strong> 50+
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-trophy text-primary me-2"></i>
                                    <strong>Success Rate:</strong> 95%
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="mission-vision bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-bullseye fa-3x text-primary mb-3"></i>
                            <h4 class="card-title">Our Mission</h4>
                            <p class="card-text text-muted">To provide quality education that empowers students with
                                knowledge, skills, and values necessary to become responsible citizens and future leaders of
                                our nation.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-eye fa-3x text-primary mb-3"></i>
                            <h4 class="card-title">Our Vision</h4>
                            <p class="card-text text-muted">To be a leading educational institution that nurtures academic
                                excellence, character development, and innovation while preserving our cultural heritage.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

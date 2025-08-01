@extends('frontend.layouts.app')

@section('title', 'Academics - Siddique Memorial School And College, Rangpur')

@section('content')
    <!-- Page Header -->
    <section class="page-header bg-primary text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold">Academics</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Academics</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Academic Overview -->
    <section class="academic-overview py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="section-title">Academic Excellence</h2>
                    <p class="lead text-muted">At Siddique Memorial School And College, we are committed to providing
                        quality education that prepares students for success in their academic and personal lives.</p>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>School Section</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success me-2"></i>Primary (Class I-V)</li>
                                <li><i class="fas fa-check text-success me-2"></i>Junior (Class VI-VIII)</li>
                                <li><i class="fas fa-check text-success me-2"></i>Secondary (Class IX-X)</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>College Section</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success me-2"></i>Science Group (XI-XII)</li>
                                <li><i class="fas fa-check text-success me-2"></i>Humanities Group (XI-XII)</li>
                                <li><i class="fas fa-check text-success me-2"></i>Business Studies (XI-XII)</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Academic Information</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <strong>Academic Year:</strong> 2024-2025
                                </li>
                                <li class="mb-3">
                                    <strong>Class Hours:</strong> 8:00 AM - 3:00 PM
                                </li>
                                <li class="mb-3">
                                    <strong>Success Rate:</strong> 95%
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Results -->
    <section class="results-section bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title text-center mb-5">Academic Results</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h3 class="text-primary">95%</h3>
                            <h5>SSC Pass Rate</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h3 class="text-primary">92%</h3>
                            <h5>HSC Pass Rate</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h3 class="text-primary">15</h3>
                            <h5>GPA 5 Students</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h3 class="text-primary">12</h3>
                            <h5>GPA 5 Students</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

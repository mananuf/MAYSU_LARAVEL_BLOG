@extends('layouts.layout')
@section('content')

     <!-- Page Header Start -->
    <div class="container-fluid page-header  wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-2">
            <h1 class="display-1 text-white animated slideInDown">503 Error</h1>
            
        </div>
    </div>
    <!-- Page Header End -->


    <!-- 503 Start -->
    <div class="container-xxl py-4 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                    <h1 class="display-1">503</h1>
                    <h1 class="mb-4">Service Unavailable</h1>
                    <p class="mb-4">Maybe go to our home page or try to use a search?</p>
                    <a class="btn btn-primary py-3 px-5" href="{{ url('/') }}">Go Back To Home</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 503 End -->    
@endsection
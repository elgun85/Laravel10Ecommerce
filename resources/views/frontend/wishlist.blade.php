
@extends('frontend.layouts.master')
@section('title',ucwords('Shopping Cart'))
@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">@yield('title')</h1>
            <div class="d-inline-flex">

            </div>
        </div>
    </div>
    <!-- Page Header End -->



    <livewire:frontend.product.wishlist/>



@endsection

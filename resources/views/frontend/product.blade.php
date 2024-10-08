
@extends('frontend.layouts.master')
@section('title',ucwords($cat->name))
@section('content')


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">{{ucwords($cat->name)}}</h1>

        </div>
    </div>
    <!-- Page Header End -->

<livewire:frontend.product.index :cat="$cat"  />

@endsection

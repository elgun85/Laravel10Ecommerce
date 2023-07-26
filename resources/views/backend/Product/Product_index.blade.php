@extends('backend.layouts.master')
@section('title','Product list')
@section('content')
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    {{--Header--}}
                    <b class="float-left"><span class="text-muted fw-light">Product /</span> @yield('title')</b>
                    <a href="{{route('product.create')}}" class="btn rounded-pill btn-primary btn-sm float-end">&nbsp;Add Product</a>
                </div>
                @if(session('message'))
                    <div class="alert alert-primary alert-dismissible" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            @endif


                <!-- / Content -->



            </div>
@endsection



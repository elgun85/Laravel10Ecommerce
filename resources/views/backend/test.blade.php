@extends('backend.layouts.master')
@section('title','Test')
@section('content')
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    {{--Header--}}
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">@yield('title') /</span> @yield('title') List</h4>



                    <livewire:admin.test.test />










                </div>
                <!-- / Content -->



            </div>
@endsection



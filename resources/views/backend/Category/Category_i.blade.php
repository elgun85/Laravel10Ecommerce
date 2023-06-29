@extends('backend.layouts.master')
@section('title','Category')
@section('content')
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Category /</span> Category List</h4>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="{{route('category.create')}}" class="btn rounded-pill btn-primary btn-sm float-end">&nbsp;Add Category</a>
                                </div>
                                <div class="card-body">table</div>
                            </div>
                        </div>
                    </div>




                </div>
                <!-- / Content -->



            </div>
@endsection



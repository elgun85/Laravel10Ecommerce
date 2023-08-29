@extends('backend.layouts.master')
@section('title','Category edit')
@section('content')
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Category /</span> Category edit
                        <a href="{{route('category.index')}}" class="btn rounded-pill btn-danger btn-sm float-end"> &nbsp;Back</a>
                    </h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                   {{-- <h5 class="card-header">Profile Details</h5>--}}

                                    <div class="card-body">
                                        <form id="formAccountSettings" action="{{route('category.update',$category->id)}}" method="POST" enctype="multipart/form-data" >
                                            @csrf
                                            @method('PUT')
                                            <!-- Account -->
                                            <div class="card-body">
                                                <div class="d-flex align-items-start align-items-sm-center gap-4">


                                                   {{-- <div class="button-wrapper">--}}

                                                    <div class="button-wrapper">
                                                        @if($category->image)
                                                        <label for="image" class=" me-2 mb-4" tabindex="0">
                                                            <span class="d-none d-sm-block">
                                                                @else
                                                                    <label for="image" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                                    <span class="d-none d-sm-block">Select  photo</span>
                                                                </label>
                                                                @endif
                                                                <img class="rounded float-start"
                                                                     id="preview-image-before-upload"
                                                                     src="@if($category->image) {{asset($category->image)}} @endif"
                                                                       style="max-height: 150px;max-width: 150px;" >
                                                            </span>

                                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                                            <input
                                                                type="file"
                                                                name="image"
                                                                id="image"
                                                                class="account-file-input"
                                                                hidden
                                                                accept="image/png, image/jpeg"
                                                            />
                                                        </label>
                                                        <p class="text-muted mb-0">Allowed Jpg,Jpeg or Png. Max size of 3072K</p>
                                                    </div>

                                                </div>
                                            </div>
                                            <hr class="my-0 mb-3" />
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label for="name" class="form-label"> Name</label>
                                                    <input
                                                        class="form-control"
                                                        type="text"
                                                        id="name"
                                                        name="name"
                                                        value="{{$category->name}}"
                                                        autofocus
                                                    />
                                                    @error('name') <smal class="text-danger">{{$message}}</smal> @enderror
                                                </div>
{{--                                                <div class="mb-3 col-md-6">
                                                    <label for="status" class="form-label">Description</label>
                                                    <input class="form-control" type="checkbox" value="" id="status" />

                                                </div>--}}
                                                <div class="mb-3 col-md-6 row">
                                                    <div class="form-check col-md-3">
                                                        <label for="status" class="form-label">Status</label>
                                                        <input type="checkbox" name="status" id="status" class="form-check"
                                                               style="width: 30px;height: 30px"
                                                            {{$category->status ==1 ?'checked' : '' }}>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="order" class="form-label">Order</label>
                                                        <input type="number" name="order" id="order" class="form-control" value="{{$category->order}}">
                                                        @error('order') <smal class="text-danger">{{$message}}</smal> @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="meta_title" class="form-label">Meta title</label>
                                                    <input class="form-control" type="text" name="meta_title" id="meta_title" value="{{$category->meta_title}}" />
                                                    @error('meta_title') <smal class="text-danger">{{$message}}</smal> @enderror
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="meta_keyword" class="form-label">Meta_keyword</label>
                                                    <input class="form-control" type="text" name="meta_keyword" id="meta_keyword" value="{{$category->meta_keyword}}" />
                                                    @error('meta_keyword') <smal class="text-danger">{{$message}}</smal> @enderror
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="meta_description" class="form-label">Meta_description</label>
                                                    <textarea id="meta_description" class="form-control" name="meta_description" id="" rows="3">{{$category->meta_description}}</textarea>
                                                    @error('meta_description') <smal class="text-danger">{{$message}}</smal> @enderror
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea id="description" class="form-control" name="description" id="description" rows="3">{{$category->description}}</textarea>
                                                    @error('description') <smal class="text-danger">{{$message}}</smal> @enderror
                                                </div>




                                            </div>
                                            <div class="mt-2">
                                                <button type="submit" class="btn btn-primary me-2">Save</button>

                                            </div>
                                        </form>
                                    </div>
                                    <!-- /Account -->
                                </div>
                            </div>

                        </div>
                </div>
                <!-- / Content -->



            </div>


            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

            <script type="text/javascript">

                $(document).ready(function (e) {


                    $('#image').change(function(){

                        let reader = new FileReader();

                        reader.onload = (e) => {

                            $('#preview-image-before-upload').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(this.files[0]);

                    });

                });

            </script>
@endsection



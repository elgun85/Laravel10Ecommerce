@extends('backend.layouts.master')
@section('title','Category create')
@section('content')
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Category /</span> Category Create
                        <a href="{{route('category.index')}}" class="btn rounded-pill btn-danger btn-sm float-end"> &nbsp;Back</a>
                    </h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <h5 class="card-header">Profile Details</h5>

                                    <div class="card-body">
                                        <form id="formAccountSettings" action="{{route('category.store')}}" method="POST" enctype="multipart/form-data" >
                                            @csrf
                                            <!-- Account -->
                                            <div class="card-body">
                                                <div class="d-flex align-items-start align-items-sm-center gap-4">

                                                    <img class="rounded float-start" id="preview-image-before-upload" src=""
                                                         style="max-height: 150px;max-width: 150px;" >
                                                    <div class="button-wrapper">
                                                        <label for="image" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                            <span class="d-none d-sm-block">Select  photo</span>
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
                                                        placeholder="Name"
                                                        autofocus
                                                    />
                                                    @error('name') <smal class="text-danger">{{$message}}</smal> @enderror
                                                </div>
{{--                                                <div class="mb-3 col-md-6">
                                                    <label for="status" class="form-label">Description</label>
                                                    <input class="form-control" type="checkbox" value="" id="status" />

                                                </div>--}}
                                                <div class="mb-3 col-md-6">
                                                    <label for="status" class="form-label">Status</label><br>
                                                    <input type="checkbox" name="status" id="status" value="">
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="meta_title" class="form-label">Meta title</label>
                                                    <input class="form-control" type="text" name="meta_title" id="meta_title" placeholder="Meta title" />
                                                    @error('meta_title') <smal class="text-danger">{{$message}}</smal> @enderror
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="meta_keyword" class="form-label">Meta_keyword</label>
                                                    <input class="form-control" type="text" name="meta_keyword" id="meta_keyword" placeholder="Meta keyword" />
                                                    @error('meta_keyword') <smal class="text-danger">{{$message}}</smal> @enderror
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="meta_description" class="form-label">Meta_description</label>
                                                    <textarea id="meta_description" class="form-control" name="meta_description" id="" rows="3">{{old('meta_description')}}</textarea>
                                                    @error('meta_description') <smal class="text-danger">{{$message}}</smal> @enderror
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea id="description" class="form-control" name="description" id="description" rows="3">{{old('description')}}</textarea>
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



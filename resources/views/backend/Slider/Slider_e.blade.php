@extends('backend.layouts.master')
@section('title','Slider')
@section('content')
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">@yield('title') /</span> @yield('title') Edit
                        <a href="{{route('slider.index')}}" class="btn rounded-pill btn-danger btn-sm float-end"> &nbsp;Back</a>
                    </h4>
                    {{--edit slider--}}
                    <div class="row">
                        <div class="col-md-12">
                            @if(session('message'))
                                <div class="alert alert-primary alert-dismissible mt-3" role="alert">
                                    {{ session('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @elseif(session('error'))
                                <div class="alert alert-danger alert-dismissible mt-3" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <div class="card shadow">

                                <div class="card-body">
                                    <form action="{{route('slider.update',$slider->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        @if($slider->image)
                                            <div class="form-group mb-3">
                                            <img src="{{asset($slider->image)}}" class="rounded mb-3"  width="150px" height="150px" alt="">
                                                <hr>
                                            </div>
                                        @endif
                                        <div class="form-group mb-3">



                                            <img id="preview"  src="#" width="150px" height="150px" alt="your image" class="rounded mb-3" style="display:none;"/>
                                            <label class="form-check-label" for="image">Select photo</label><br>
                                            <input id="image" type="file"  name="image" wire:model="image"   class="form-control mt-3" >
                                            @error('image') <smal class="text-danger">{{$message}}</smal> @enderror
                                        </div>


                                        <div class="form-group mb-3 ">
                                            <label class="form-check-label" for="name">Title</label><br>

                                            <input id="name" type="text"  name="name"  placeholder="Name slider" class="form-control mt-3" value="{{$slider->name}}">
                                            @error('name') <smal class="text-danger">{{$message}}</smal> @enderror

                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-check-label" for="inlineCheckbox2">Status</label><br>
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                                   name="status" style="width: 30px;height: 30px" {{$slider->status ==1 ?'checked' : '' }} >
                                            @error('status') <smal class="text-danger">{{$message}}</smal> @enderror
                                        </div>






                                        <div class="form-group mb-3">
                                            <label for="description" class="form-check-label">Description</label>
                                            <textarea id="description" class="form-control" name="description"  id="" rows="3">{{$slider->description}}</textarea>
                                            @error('description') <smal class="text-danger">{{$message}}</smal> @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <button type="submit" class="btn btn-primary float-end">Update</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    {{-- / edit slider--}}
                </div>
                <!-- / Content -->

            </div>


            <script>
                image.onchange = evt => {
                    preview = document.getElementById('preview');
                    preview.style.display = 'block';
                    const [file] = image.files
                    if (file) {
                        preview.src = URL.createObjectURL(file)
                    }
                }
            </script>


@endsection



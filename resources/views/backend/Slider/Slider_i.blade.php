@extends('backend.layouts.master')
@section('title','Slider')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">@yield('title') /</span> @yield('title') Create
                <a href="{{route('slider.create')}}" class="btn rounded-pill btn-primary btn-sm float-end"> &nbsp;Create</a>
            </h4>


            {{--slider list--}}
            <div class="row mt-3">
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
                            <table class="table  table-striped table-hover ">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($sliders as $slider)
                                    <tr>
                                        <td>{{$slider->id}}</td>
                                        <td>{{$slider->name}}</td>
                                        <td>
                                            @if($slider->image)
                                            <img src="{{asset($slider->image)}}" width="50px" height="50px" alt="">
                                            @else

                                            @endif
                                        </td>
                                        <td>{{$slider->status == '1'? 'Hidden':'Visible'}}</td>
                                        <td>
                                            <a href="{{route('slider.edit',$slider->id)}}" class="btn btn-outline-primary btn-sm" ><i class='bx bx-edit-alt'></i></a>
                                            <a href="{{route('slider.delete',$slider->id)}}" class="btn btn-outline-danger btn-sm"
                                               onclick="return confirm('Are you sure,you want to delete this data?')"
                                            ><i class='bx bx-trash'></i> </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5">No slider Found</td></tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="mt-2">
                                {{$sliders->links('pagination::bootstrap-4')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--/ slider list--}}





        </div>
    </div>

@endsection





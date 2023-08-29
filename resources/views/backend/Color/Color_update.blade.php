@extends('backend.layouts.master')
@section('title','Color update page')
@section('content')
    <div class="content-wrapper">
       <div class="container-xxl flex-grow-1 container-p-y">

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

               <div class="col-md-6">
                   <div class="card shadow">
                       <div class="card-header bg-secondary  mb-3" s>
                           <h5 class="card-title text-white" >Update Color</h5>
                       </div>
                       <div class="card-body">
                           <form action="{{route('color.update',$color->id)}}" method="post">
                               @csrf
                               @method('PUT')
                               <div class="form-group ">
                                   <label for="exampleColorInput" class="form-label">Color picker</label>
                                   <input type="color" name="code" class="form-control form-control-color" id="exampleColorInput" value="{{$color->code}}" title="Choose your color">
                                   @error('code') <smal class="text-danger">{{$message}}</smal> @enderror

                                   <input type="text" required name="name"  placeholder="Name color" class="form-control mt-3" value="{{$color->name}}">
                                   @error('name') <smal class="text-danger">{{$message}}</smal> @enderror

                               </div>

                               <div class="form-group mt-3">
                                   <label class="form-check-label" for="inlineCheckbox2">Status</label><br>
                                   <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                          name="status" style="width: 30px;height: 30px"
                                       {{$color->status  =='1'? 'checked':''}}
                                   >

                                   @error('status') <smal class="text-danger">{{$message}}</smal> @enderror
                               </div>

                               <div class="form-group mt-3">
                                   <button type="submit" class="btn btn-primary float-end">Update</button>
                               </div>

                           </form>
                       </div>
                   </div>
               </div>


               <div class="col-md-6">
                   <div class="card shadow">
                       <div class="card-header bg-secondary  mb-3" s>
                           <h5 class="card-title text-white" > Color List</h5>
                       </div>
                       <div class="card-body">
                           <table class="table table-bordered table-striped table-hover ">
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
                                                                 @forelse($colors as $color)
                                        <tr>
                                            <td>{{$color->id}}</td>
                                            <td>{{$color->name}}</td>
                                            @if($color->name=='white')
                                                <td>
                                                    <span class="badge rounded-pill" style="background-color: {{$color->code}}"><b style="color: #0f0f0f">{{$color->code}}</b></span>
                                                </td>


                                            @else
                                                <td>
                                                    <span class="badge rounded-pill" style="background-color: {{$color->code}}"><b >{{$color->code}}</b></span>
                                                </td>

                                            @endif                                            <td>{{$color->status == '1'? 'Hidden':'Visible'}}</td>
                                            <td>
                                                <a href="{{route('color.edit',$color->id)}}" class="btn btn-outline-primary btn-sm" ><i class='bx bx-edit-alt'></i></a>
                                                <a href="{{route('color.delete',$color->id)}}" class="btn btn-outline-danger btn-sm"
                                                   onclick="return confirm('Are you sure,you want to delete this data?')"
                                                ><i class='bx bx-trash'></i> </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5">No Color Found</td></tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="mt-2">
                                   {{$colors->links('pagination::bootstrap-4')}}
                                </div>
                            </div>
                        </div>
                    </div>
           </div>





        </div>
    </div>
@endsection



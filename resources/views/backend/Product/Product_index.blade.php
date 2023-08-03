@extends('backend.layouts.master')
@section('title','Product list')
@section('content')
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">

<div class="card-body">
    {{--Header--}}
    <b class="float-left"><span class="text-muted fw-light">Product /</span> @yield('title')</b>
    <a href="{{route('product.create')}}" class="btn rounded-pill btn-primary btn-sm float-end">&nbsp;Add Product</a>


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
    {{--Table start--}}

    <table class="table table-bordered table-striped table-hover mt-3">
        <thead>
        <tr>
            <th>Id</th>
            <th>Product</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                 <td>{{$product->category->name}}</td>
                <td>{{$product->brand}}</td>
                <td>{{$product->selling_price}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->status == '1'? 'Hidden':'Visible'}}</td>
                <td>
                    <a href="{{route('product.edit',$product->id)}}" class="btn btn-outline-primary btn-sm" ><i class='bx bx-edit-alt'></i></a>
                    {{-- <a href="{{route('product.delete',$product->id)}}"--}}
                    <a href="{{route('product.delete',$product->id)}}"
                       onclick="return confirm('Are you sure,you want to delete this data?')"
                       class="btn btn-outline-danger btn-sm">
                        <i class='bx bx-trash'></i>
                    </a>
                </td>
            </tr>
        @empty
            <tr><td colspan="8" class="text-center">No Brand Available</td></tr>
        @endforelse
        </tbody>
    </table>
    {{--Table finish--}}
</div>
                </div>



                <!-- / Content -->



            </div>

@endsection



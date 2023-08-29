@extends('backend.layouts.master')
@section('title','Product update')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Category /</span> @yield('title')
                <a href="{{route('product.index')}}" class="btn rounded-pill btn-danger btn-sm float-end"> &nbsp;Back</a>
            </h4>
            @if(session()->has('message'))
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alet alert-danger">
                                    @foreach($errors->all() as $error)
                                        <ul><li>{{$error}}</li></ul>
                                    @endforeach
                                </div>
                            @endif

                            <form action="{{route('product.update',$products->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag" type="button" role="tab" aria-controls="seotag" aria-selected="false">SEO tags</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">Details</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image" type="button" role="tab" aria-controls="image" aria-selected="false">Image</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color" type="button" role="tab" aria-controls="color" aria-selected="false">Colors</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                                    {{--home--}}
                                <div class="tab-pane fade border p-3 show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="form-group mb-3">
                                        <label for="exampleFormControlCategory" class="form-label">Category</label>
                                        <select class="form-select" id="exampleFormControlCategory" name="category_id">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}"  {{$category->id == $products->category_id ? 'selected':''}}>

                                                    {{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleFormControlName" class="form-label">Name</label>
                                        <input id="exampleFormControlName" type="text" name="name"  class="form-control" value="{{$products->name}}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="exampleFormControlBrand" class="form-label">Brand</label>
                                        <select name="brand" id="exampleFormControlBrand" class="form-select">
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->name}}" {{$brand->name == $products->brand ? 'selected':''}}>
                                                    {{$brand->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group  mb-3">
                                        <label for="Description" class="form-label">Description</label>
                                        <textarea id="Description" class="form-control" name="description" id="" rows="3">{{$products->description}}</textarea>
                                    </div>

                                    <div class="form-group  mb-3">
                                        <label for="Small_description" class="form-label">Small_description</label>
                                        <textarea id="Small_description" class="form-control" name="small_description" id="" rows="3">{{$products->small_description}}</textarea>
                                    </div>

                                </div>
                                            {{--Seo tags--}}
                                <div class="tab-pane fade border p-3" id="seotag" role="tabpanel" aria-labelledby="seotag-tab">
                                    <div class="form-group mb-3">
                                        <label for="meta_title" class="form-label">Meta_title</label>
                                        <input id="meta_title" type="text" name="meta_title" placeholder="meta_title" class="form-control" value="{{$products->meta_title}}">
                                    </div>

                                    <div class="form-group  mb-3">
                                        <label for="meta_keyword" class="form-label">Meta_keyword</label>
                                        <textarea id="meta_keyword" class="form-control" name="meta_keyword" id="" rows="3">{{$products->meta_keyword}}</textarea>
                                    </div>

                                    <div class="form-group  mb-3">
                                        <label for="meta_description" class="form-label">Meta_description</label>
                                        <textarea id="meta_description" class="form-control" name="meta_description" id="" rows="3">{{$products->meta_description}}</textarea>
                                    </div>
                                </div>
                                              {{--Details--}}
                                <div class="tab-pane fade border p-3" id="details" role="tabpanel" aria-labelledby="details-tab">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="original_price" class="form-label">Original_price</label>
                                                <input id="original_price" type="number" name="original_price"  class="form-control" value="{{$products->original_price}}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="selling_price" class="form-label">Selling_price</label>
                                                <input id="selling_price" type="number" name="selling_price"  class="form-control" value="{{$products->selling_price}}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="quantity" class="form-label">Quantity</label>
                                                <input id="quantity" type="number" name="quantity" class="form-control" value="{{$products->quantity}}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="trending" class="form-label">Trending</label>
                                                <input id="trending" type="checkbox" name="trending" style="width: 50px;height: 50px"
                                                    {{$products->trending  =='1'? 'checked':''}}>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <input id="status" type="checkbox" name="status" style="width: 50px;height: 50px"
                                                    {{$products->status  =='1'? 'checked':''}}>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--Image--}}
                                <div class="tab-pane fade border p-3" id="image" role="tabpanel" aria-labelledby="image-tab">


                                    <div class="form-group mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control"  name="image[]" multiple placeholder="Choose image" id="image">

                                    </div>

                                    <div class="">
                                        @if($products->productImages)
                                           <div class="row">
                                               @foreach($products->productImages as $image)
                                                   <div class="col-md-1">
                                                       <img src="{{asset($image->image)}}" style="width: 80px;height: 80px" alt="img" class="me-4 border">
                                                       <a href="{{route('product.ProductImageDel',$image->id)}}" class="d-block  btn-outline-danger align text-center">
                                                           <i class='bx bx-x-circle bx bxs-like bx-md' ></i>
                                                           {{--<i class='bx bxs-x-circle bx bxs-like bx-lg'></i>--}}
                                                       </a>
                                                   </div>
                                               @endforeach
                                           </div>
                                        @else
                                            <h4> No added image</h4>
                                        @endif
                                    </div>

                                </div>


                                {{--Color--}}
                                <div class="tab-pane fade border p-3" id="color" role="tabpanel" aria-labelledby="color-tab">
                                    <h3>Add Product Color</h3>
                                    <label for=""><b>Select Color</b></label>
                                    <hr>
                                    <div class="row ">
                                        @forelse($colors as $colorItem)
                                            <div class="col-md-3">
                                                <div class="p-2 border mb-3">


                                                    Color:  <input type="checkbox" class="form-check-input"  name="colors[{{$colorItem->id}}]" multiple  id="color" value="{{$colorItem->id}}" >
                                                    @if($colorItem->name == 'white' or $colorItem->name =='White')
                                                        <b style="color: #0f0f0f">{{$colorItem->name}}</b>
                                                    @else
                                                        <b style="color: {{$colorItem->code}}">{{$colorItem->name}}</b>
                                                    @endif

                                                    <br>
                                                    Quantity: <input type="number" name="Color_quantity[{{$colorItem->id}}]"  style="width: 70px;border: 1px solid">
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-md-12">
                                                <h2>No colors Found</h2>
                                            </div>

                                        @endforelse
                                    </div>


<livewire:admin.productcolor.procolor-update :col_id="$products->id"/>
{{--    @if($products->ProductColor->count() > 0)
        <table class="table table-bordered table-sm ">
            <thead>
            <tr>
                <th>Color Name</th>
                <th>Quantity</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
       @foreach($products->ProductColor as $prodColor)
           <tr class="prod-color-tr">
               <td>
                   @if($prodColor->color->name == 'white' or $prodColor->color->name == 'White')
                       <span class="badge rounded-pill " style="background-color: {{$prodColor->color->code}};color: #0f0f0f">{{$prodColor->color->name}}</span>
                   @else
                       <span class="badge rounded-pill text-white" style="background-color: {{$prodColor->color->code}}">{{$prodColor->color->name}}</span>

                   @endif
               </td>
               <td>
                   <div class="input-group mb-3" style="width: 150px">
                       <input type="text" wire:modal="ColorQuantity"
                              value="{{$prodColor->Color_quantity}}"
                              class="ProductColorQuantity form-control form-control-sm">
                       <button wire:click.prevent="ProductColorUpdate({{$prodColor->id}})"
                          type="button" value="{{$prodColor->id}}"
                          class="ProductColorUpdate btn btn-primary btn-sm text-white">Update</button>
                   </div></td>
               <td>
                   <button type="button" wire:click.prevent="ProductColorDelete({{$prodColor->id}})" value="{{$prodColor->id}}" class="ProductColorDelete btn btn-danger btn-sm text-white">Delete</button>
               </td>
           </tr>
       @endforeach
       </tbody>
   </table>
       @else
        <h1>no Selected Color</h1>
       @endif--}}
   </div>

            <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" class="btn btn-outline-primary btn-sm float-end btn-rounded mt-3"> Update</button>
            </div>
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

{{--    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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

    </script>--}}
@endsection
{{--@section('scripts')
    <script>
        $(document).ready(function (){
           $(document).on('click','.ProductColorUpdate',function (){
               $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               });

               var product_id="{{$products->id}}";
              var prod_color_id =$(this).val();
              var qty =$(this).closest('.prod-color-tr').find('.ProductColorQuantity').val();

             // alert(prod_color_id);
               if (qty <=0){
                   alert('Quantity is required');
                   return false;
               }
               var data={
                   'product_id':product_id,
                   'prod_color_id':prod_color_id,
                   'qty':qty
               };
               $.ajax({
                   type:"method",
                   url:"/back/product/"+prod_color_id,
                   data:data,
                   success:function (response){
                       alert(response.message)
                   }
               })
           });
        });
    </script>
@endsection--}}


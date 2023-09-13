<div>


    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Brands Start -->
                @if($cat->brands)
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by Brands</h5>
                    @foreach($cat->brands as $brandItem)
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input"
                                   wire:model="brandInputs" id="brand-{{$brandItem->id}}" value="{{$brandItem->name}}">
                            <label class="custom-control-label" for="brand-{{$brandItem->id}}">{{ucwords($brandItem->name)}}</label>
                            <span class="badge border font-weight-normal">
                                {{$brandItem->prod->count()}}
                            </span>
                        </div>
                        @endforeach
                </div>
                @endif
{{--                <!-- Brands End -->

                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all">
                            <label class="custom-control-label" for="price-all">All Price</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-1">
                            <label class="custom-control-label" for="price-1">$0 - $100</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>


                    </form>
                </div>
                <!-- Price End -->

                <!-- Color Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by color</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="color-all">
                            <label class="custom-control-label" for="price-all">All Color</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-1">
                            <label class="custom-control-label" for="color-1">Black</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>

                    </form>
                </div>
                <!-- Color End -->

                <!-- Size Start -->
                <div class="mb-5">
                    <h5 class="font-weight-semi-bold mb-4">Filter by size</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">XS</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                    </form>
                </div>
                <!-- Size End -->--}}
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <div class="dropdown ml-4">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    Sort by
                                </button>
                                <div class="dropdown-menu dropdown-menu-right " aria-labelledby="triggerId">
                                    <div class="form-check ml-2">
                                        <input wire:model="priceInput" value="higntolow" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            High to Low
                                        </label>
                                    </div>
                                    <div class="form-check ml-2">
                                        <input wire:model="priceInput" value="lowtohign"  class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Low to High
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{--product--}}
                    @forelse($products as $product)
                        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    @if($product->quantity>0)
                                        <button type="button" class="btn btn-success btn-sm float-end resimYazisi">In stock</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm float-left resimYazisi">Out stock</button>
                                    @endif
                                    @if($product->productImages->count()>0)
                                        <a href="{{route('product_view',[$cat->slug,$product->name])}}">
                                            <img class="img-fluid w-100 " style="height: 300px;width: 200px"  src="{{asset($product->productImages[0]->image)}}" alt="{{$product->name}}">
                                            <style>
                                                .resimKapsayici {position:relative}
                                                .resimYazisi {position:absolute;right:10px;top:10px;}
                                            </style>
                                        </a>
                                    @endif
                                </div>
                                <div class="card-body border-left border-right text-left  p-0 pt-4 pb-3">
                                    <h5 class="text-truncate mb-3 ml-3 text-info ">{{ucwords($product->name)}}</h5>
                                    <span class="text-truncate ml-3 mb-3  ">{{ucwords($product->category->name)}}/{{ucwords($product->brand)}}</span>
                                    <div class="d-flex ml-3">
                                        <h6>{{$product->selling_price}}$ </h6><h6 class="text-muted ml-2"><del> {{$product->original_price}} $</del></h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="{{route('product_view',[$cat->slug,$product->name])}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                </div>
                            </div>
                        </div>



                    @empty
                        <div class="col-md-12">
                            <h1> No {{$cat->name}} products  available </h1>
                        </div>
                    @endforelse
                    {{-- / product--}}


                    {{--                    <div class="col-12 pb-1">
                                            <nav aria-label="Page navigation">
                                                <ul class="pagination justify-content-center mb-3">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                    </li>
                                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>--}}
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
</div>

<div>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <b class="float-left"><span class="text-muted fw-light">Brand /</span> Brand List</b>
                            <a href="{{route('brand.create')}}"
                               class="btn rounded-pill btn-primary btn-sm float-end"
                               data-bs-toggle="modal" data-bs-target="#createModal">&nbsp;Add brand</a>
                        </div>
                        @if(session('message'))
                            <div class="alert alert-primary alert-dismissible" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @forelse($brands as $brand)
                                    <tr>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{$brand->name}}</strong></td>

                                        <td>{{$brand->slug}}</td>
                                        <td><span class="badge bg-label-{{$brand->status== '1'? 'primary':'danger'}} me-1">{{$brand->status== '1'? 'Hidden':'Visible'}}</span></td>
                                        <td>
                                            <a href="#" wire:click="editBrand({{$brand->id}})"
                                               data-bs-toggle="modal" data-bs-target="#updateBrandModal"
                                               class="btn btn-outline-primary btn-sm " >
                                                <i class='bx bx-edit-alt'></i>


                                                <a href="#" wire:click="deleteBrand({{$brand->id}})"
                                                   class="btn btn-outline-danger btn-sm "
                                                   data-bs-toggle="modal" data-bs-target="#deleteBrandModal"
{{--
                                                     onclick="return confirm('Are you sure,you want to delete this data?')"
--}}
                                                >  <i class='bx bx-trash'></i></a></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"> No Brands found</td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                            <div class="pagination justify-content-center">
                                {{$brands->links()}}
                            </div>
                        </div>
                        <!-- Hoverable Table rows -->

                     @include('livewire.admin.brand.brandModal')
                    </div>
                </div>
            </div>




        </div>
        <!-- / Content -->



    </div>
    @section('scripts')
        <script>
            window.livewire.on('close-modal',event => {
                $('#createModal').modal('hide');
                $('#updateBrandModal').modal('hide');
                $('#deleteBrandModal').modal('hide');
            });
        </script>
    @endsection
</div>



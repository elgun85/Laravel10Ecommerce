<div>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <b class="float-left"><span class="text-muted fw-light">Category /</span> Category List</b>
                            <a href="{{route('category.create')}}" class="btn rounded-pill btn-primary btn-sm float-end">&nbsp;Add Category</a>
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
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @foreach($categories as $category)
                                    <tr>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{$category->name}}</strong></td>

                                        <td>
                                            {{--
                                                                                            <img src="{{asset('backend/')}}/assets/img/avatars/5.png" width="50" height="50" alt="Avatar" class="rounded-circle" />
                                            --}}
                                            <img src="{{asset($category->image)}}" width="50" height="50" alt="Avatar" class="rounded-circle" />

                                        </td>
                                        <td><span class="badge bg-label-{{$category->status== '1'? 'primary':'danger'}} me-1">{{$category->status== '1'? 'Hidden':'Visible'}}</span></td>
                                        <td>
                                            <a href="{{route('category.edit',$category->id)}}" class="btn btn-outline-primary btn-sm mr-3 ml-3" >
                                                <i class='bx bx-edit-alt'></i>


                                                <a href="#" wire:click="deleteCategory({{$category->id}})"
                                                   class="btn btn-outline-danger btn-sm"
                                                   data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                  {{-- onclick="return confirm('Are you sure,you want to delete this data?')"--}}
                                                >  <i class='bx bx-trash'></i></a></a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="pagination justify-content-center">
                                {{$categories->links()}}
                            </div>
                        </div>
                        <!-- Hoverable Table rows -->

                        <!-- Modal -->
                        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Category delete</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form wire:submit.prevent="destroyCategory">
                                       <div class="modal-body">
                                           <h6>Are you sure,you want to delete this data?</h6>
                                       </div>
                                       <div class="modal-footer">
                                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                           <button type="submit" class="btn btn-danger">Delete</button>
                                       </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>




        </div>
        <!-- / Content -->



    </div>
    @section('scripts')
        <script>
            window.livewire.on('close-modal',event => {
                $('#deleteModal').modal('hide');
            });
        </script>
    @endsection
</div>



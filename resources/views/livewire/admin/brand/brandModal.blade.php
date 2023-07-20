<!-- create Modal -->
<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Brand</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="createBrand">
                <div class="modal-body">


                        <div class="form-group">
                            <label for="name">Name </label>
                            <input type="text" wire:model.defer="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter Name">
                            @error('name') <smal id="nameHelp" class="form-text  text-danger">{{$message}}</smal> @enderror
                        </div>

                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" wire:model.defer="slug" class="form-control" id="slug" aria-describedby="slugHelp" placeholder="Enter Slug">
                            @error('slug') <smal id="nameHelp" class="form-text  text-danger">{{$message}}</smal> @enderror
                        </div>


                        <div class="form-check">
                            <input type="checkbox" wire:model.defer="status" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Status</label>
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">brand delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroybrand">
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

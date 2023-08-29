<div>

    <div class="container">
        <div class="card-body ">
<div class="row justify-content-sm-center ">
    <div class="col-md-9 ">
        @if(session()->has('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        @if($updadeMode)
                <form wire:submit.prevent="updateData" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputimage">Image</label>
                        <input wire:model="images"  type="file" class="form-control" id="exampleInputimage" aria-describedby="emailHelp" placeholder="Image" multiple>
                        @error('image') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Name</label>
                        <input wire:model="name" type="text" class="form-control" id="exampleInputPassword1" placeholder="Name">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Title</label>
                        <input wire:model="title" type="text" class="form-control" id="exampleInputPassword1" placeholder="Title">
                        @error('title') <span class="text-danger">{{$message}}</span> @enderror

                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <div class="form-group">
                    </div>
                    <button type="submit" class="btn btn-primary float-end  ">Update</button>
                </form>

            @else
                <form wire:submit.prevent="addTest" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputimage">Image</label>
                        <input wire:model="images"  type="file" class="form-control" id="exampleInputimage" aria-describedby="emailHelp" placeholder="Image" multiple>
                        @error('image') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Name</label>
                        <input wire:model="name" type="text" class="form-control" id="exampleInputPassword1" placeholder="Name">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Title</label>
                        <input wire:model="title" type="text" class="form-control" id="exampleInputPassword1" placeholder="Title">
                        @error('title') <span class="text-danger">{{$message}}</span> @enderror

                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <div class="form-group">
                    </div>
                    <button type="submit" class="btn btn-primary float-end  ">Submit</button>
                </form>
            @endif
    </div>

</div>
        </div>
    </div>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">File</th>
            <th scope="col">Last</th>
            <th scope="col">Last</th>
            <th scope="col">***</th>
        </tr>
        </thead>
        <tbody>

            @foreach($test as $data)
                <tr>
            <th scope="row">{{$data->id}}</th>
                    <td><img src="{{asset($data->images)}}" style="width: 150px;height: 100px" alt=""></td>
            <td>{{$data->name}}</td>
            <td>{{$data->title}}</td>
            <td>
                <button type="button" wire:click.prevent="editTest({{$data->id}})" class="btn btn-sm btn-outline-secondary ">Edit</button>
                <button type="button" wire:click.prevent="deleteTest({{$data->id}})" class="btn btn-sm btn-outline-danger ">Delete</button>
            </td>
                </tr>
            @endforeach


        </tbody>
    </table>


</div>

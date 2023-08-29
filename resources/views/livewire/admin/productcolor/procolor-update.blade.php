<div>

    @if($products->ProductColor->count() > 0)
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
                            <input type="number" wire:model.defer="colqun"
                                   value="{{$prodColor->Color_quantity}}"


                                   class="form-control form-control-sm">
                            <button wire:click.prevent="ProductColorUpdate({{$prodColor->color_id}})"
                                      type="button"
                                    class="ProductColorUpdate btn btn-primary btn-sm text-white">{{$prodColor->Color_quantity}}Update</button>
                        </div></td>
                    <td>
                        <button type="button" wire:click.prevent="ProductColorDelete({{$prodColor->color_id}})"
                                class="ProductColorDelete btn btn-danger btn-sm text-white">Delete</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h1>no Selected Color</h1>
    @endif
</div>

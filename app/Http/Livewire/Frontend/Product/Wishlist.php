<?php

namespace App\Http\Livewire\Frontend\Product;


use Livewire\Component;


class Wishlist extends Component
{

    public function wistlistdelete($id)
    {
        $whishlist=\App\Models\Wishlist::where('user_id',auth()->user()->id)->where('id',$id)->delete();
        $this->dispatchBrowserEvent('message',
            [
                'text'=>'Wishlist deleted ',
                'type'=>'success',
                'status'=>200
            ]);
    }

    public function render()
    {
        $wishlist=\App\Models\Wishlist::where('user_id', auth()->user()->id)->get();
      //  dd($wishlist);
        return view('livewire.frontend.product.wishlist',compact('wishlist'));
    }
}

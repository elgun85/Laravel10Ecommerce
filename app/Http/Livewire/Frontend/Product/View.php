<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\ProductColor;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $cat,$product,$prodColorSelectQuantity,$calorid;

    public function mount($cat,$product)
    {
        $this->cat=$cat;
        $this->product=$product;
    }
public function addWishList($product_id)
{
   if (Auth::check())
   {
       if (Wishlist::where('user_id',Auth::user()->id)->where('product_id',$product_id)->exists())
       {
        //   session()->flash('error','Already added to Wishlist');
           $this->dispatchBrowserEvent('message',
               [
                   'text'=>'Already added to Wishlist',
                   'type'=>'warning',
                   'status'=>409
               ]);

       }
       else
       {
           $wishlist=Wishlist::create([
               'user_id'=>Auth::user()->id,
               'product_id'=>$product_id
           ]);
        //  session()->flash('message','Wishlist added succecfully');
           $this->dispatchBrowserEvent('message',
               [
                   'text'=>'Wishlist added succecfully',
                   'type'=>'success',
                   'status'=>200
               ]);
       }


   }else{
    //   session()->flash('error','Please Login to contunie');
       $this->dispatchBrowserEvent('message',
       [
           'text'=>'Please Login to contunie',
           'type'=>'error',
           'status'=>401
       ]);
       return false;
   }
}

    public function colorSelected($productColorId)
    {
      $product= $this->product->ProductColor()->where('id',$productColorId)->first();
       $this->prodColorSelectQuantity=$product->Color_quantity;
       $this->calorid=$product->color->name;
       if ($this->prodColorSelectQuantity==0)
       {
           $this->prodColorSelectQuantity='outStock';
       }
    }
    public function render()
    {
        return view('livewire.frontend.product.view',[
            'category'=>$this->cat,
            'product'=>$this->product,
        ]);
    }
}

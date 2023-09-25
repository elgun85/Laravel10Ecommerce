<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\ProductColor;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $cat,$product,$prodColorSelectQuantity,$calorid,$quantityCount=1,$productColorId;

    public function decrementQuantity()
    {
        if ($this->quantityCount > 1 )
        {
            $this->quantityCount --;
        }
    }

    public function incrementQuantity()
    {
        if ($this->quantityCount < 10)
        {
            $this->quantityCount ++;
        }
    }

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
           $this->emit('wishlistAddedUpdated'); //wishlistde siyahidan silende yuxarisa wishlist ceminden avtomatik update elemek  ucun

           //wishlistde siyahidan silende ve ya add edende yuxarida wishlist ceminden avtomatik silmek ucun || wishlistAddedUpdated wishlist showda ->delete() sonra yaz $this->emit('wishlistAddedUpdated');
         //  protected $listeners = ['wishlistAddedUpdated' => 'checkWishlistCount'];


           $this->dispatchBrowserEvent('message',
               [
                   'text'=>'Wishlist added succecfully',
                   'type'=>'success',
                   'status'=>200
               ]);
       }


   }else{
       $this->dispatchBrowserEvent('message',
       [
           'text'=>'Please Login to contunie',
           'type'=>'error',
           'status'=>401
       ]);
       return false;
   }
}

    public function addToCart($product_id)
        {
           if (Auth::check())
           {
               if ($this->product->where('id',$product_id)->where('status',0)->exists())
               {
                   //Check for color quantity and add to card   --- mehsulun rengi ile max ne qeder goture bilersen
                   if ($this->product->ProductColor()->count() >1)
                   {
                       if ($this->prodColorSelectQuantity != NULL)
                       {
                           if (Cart::where('user_id',Auth::user()->id)
                               ->where('product_id',$product_id)
                               ->where('product_color_id',$this->productColorId)
                               ->exists())
                           {
                               $this->dispatchBrowserEvent('message',
                                   [
                                       'text'=>'Product Already Added',
                                       'type'=>'warning',
                                       'status'=>404
                                   ]);
                           }
                           else
                           {
                               $prodColor=$this->product->ProductColor()->where('id',$this->productColorId)->first();
                               if ($prodColor->Color_quantity > 0)
                               {
                                   if ($prodColor->Color_quantity >= $this->quantityCount)
                                   {
                                       Cart::create(
                                           [
                                               'user_id'=>Auth::user()->id,
                                               'product_id'=>$product_id,
                                               'product_color_id'=>$this->productColorId,
                                               'quantity'=>$this->quantityCount
                                           ]
                                       );
                                       $this->emit('cardAddedUpdate');
                                       $this->dispatchBrowserEvent('message',
                                           [
                                               'text'=>'Product Added to Card',
                                               'type'=>'success',
                                               'status'=>200
                                           ]);
                                   }
                                   else
                                   {
                                       $this->dispatchBrowserEvent('message',
                                           [
                                               'text'=>'Only ' . $prodColor->Color_quantity . ' Quantity Avialable',
                                               'type'=>'warning',
                                               'status'=>404
                                           ]);
                                   }
                               }
                               else
                               {
                                   $this->dispatchBrowserEvent('message',
                                       [
                                           'text'=>'Select you product color',
                                           'type'=>'info',
                                           'status'=>404
                                       ]);
                               }
                           }

                       }
                       else
                       {
                           $this->dispatchBrowserEvent('message',
                               [
                                   'text'=>'Select you product color',
                                   'type'=>'info',
                                   'status'=>404
                               ]);
                       }
                   }
                   else
                   {
                       if (Cart::where('user_id',Auth::user()->id)->where('product_id',$product_id)->exists())
                       {
                           $this->dispatchBrowserEvent('message',
                               [
                                   'text'=>'Product Already Added',
                                   'type'=>'warning',
                                   'status'=>404
                               ]);
                       }
                       else
                       {
                           if ($this->product->quantity>0)
                           {
                               if ($this->product->quantity >= $this->quantityCount)
                               {
                                   //insert product to cart
                                   Cart::create(
                                       [
                                           'user_id'=>Auth::user()->id,
                                           'product_id'=>$product_id,
                                           'quantity'=>$this->quantityCount
                                       ]
                                   );
                                   $this->emit('cardAddedUpdate');

                                   $this->dispatchBrowserEvent('message',
                                       [
                                           'text'=>'Product Added to Card',
                                           'type'=>'success',
                                           'status'=>200
                                       ]);
                               }
                               else
                               {
                                   $this->dispatchBrowserEvent('message',
                                       [
                                           'text'=>'Only ' .$this->product->quantity. ' Quantity Avialable',
                                           'type'=>'warning',
                                           'status'=>404
                                       ]);
                               }
                           }
                           else
                           {
                               $this->dispatchBrowserEvent('message',
                                   [
                                       'text'=>'Out off stock',
                                       'type'=>'warning',
                                       'status'=>404
                                   ]);
                           }
                       }
                   }

               }
               else
               {
                   $this->dispatchBrowserEvent('message',
                       [
                           'text'=>'Please Does not exists',
                           'type'=>'warning',
                           'status'=>404
                       ]);
               }
           }
           else
           {
               $this->dispatchBrowserEvent('message',
                   [
                       'text'=>'Please Login to add to cart',
                       'type'=>'info',
                       'status'=>401
                   ]);
           }

        }

    public function colorSelected($productColorId)
    {
       $this->productColorId =$productColorId;
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

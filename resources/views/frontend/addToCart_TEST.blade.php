<?php
namespace App\Http\Livewire\Frontend\Product;

use App\Models\ProductColor;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $cat,$product,$prodColorSelectQuantity,$calorid,$quantityCount=1,$productColorId;



    public function addToCard(int $productcardId)
    {
       if (Auth::check())
       {
           if ($this->product->where('id',$productcardId)->where('status',0)->exists())
           {
               if ($this->product->productColors()->count()>1)
               {
                   if ( $this->productColorSelectedQuantity !=NULL)
                   {
                       if (card::where('user_id',Auth::user()->id)
                           ->where('product_id',$productcardId)
                           ->where('product_color_id',$this->productColorId)
                           ->exists())
                       {
                           $this->dispatchBrowserEvent('message', [
                               'text' => 'Product already added',
                               'type' => 'error',
                               'status' => 500
                           ]);
                       }
                       else
                       {
                           $productColor=$this->product->productColors()->where('id',$this->productColorId)->first();
                           if ($productColor->Color_quantity>0)
                           {
                               if ($productColor->Color_quantity > $this->quantityCount)
                               {
                                   card::create([
                                       'user_id'           =>  Auth::user()->id,
                                       'product_id'        =>  $productcardId,
                                       'product_color_id'  =>  $this->productColorId,
                                       'quantity'          =>  $this->quantityCount
                                   ]);
                                   $this->emit('CartAddedUpdated');
                                   $this->dispatchBrowserEvent('message', [
                                       'text' => 'Product added to Card',
                                       'type' => 'success',
                                       'status' => 200
                                   ]);
                               }
                               else
                               {
                                   $this->dispatchBrowserEvent('message', [
                                       'text' => 'Only '. $productColor->Color_quantity  .' Quantity avialable',
                                       'type' => 'error',
                                       'status' => 500
                                   ]);
                               }
                           }
                           else
                           {
                               $this->dispatchBrowserEvent('message', [
                                   'text' => 'Out Off Stock',
                                   'type' => 'error',
                                   'status' => 500
                               ]);
                           }
                       }
                   }
                   else
                   {
                       $this->dispatchBrowserEvent('message', [
                           'text' => 'Select Your Product Color',
                           'type' => 'error',
                           'status' => 500
                       ]);
                   }
               }
               else
               {
                   if (card::where('user_id',Auth::user()->id)
                       ->where('product_id',$productcardId)
                       ->exists())
                   {
                       $this->dispatchBrowserEvent('message', [
                           'text' => 'Product already added',
                           'type' => 'info',
                           'status' => 401
                       ]);
                   }
                   else
                   {
                       if ($this->product->quantity>0)
                       {
                           if ($this->product->quantity > $this->quantityCount)
                           {
                                   card::create([
                                   'user_id'           =>  Auth::user()->id,
                                   'product_id'        =>  $productcardId,
                                   'product_color_id'  =>  $this->productColorId,
                                   'quantity'          =>  $this->quantityCount
                               ]);
                               $this->emit('CartAddedUpdated');
                               $this->dispatchBrowserEvent('message', [
                                   'text' => 'Product added to Card',
                                   'type' => 'success',
                                   'status' => 200
                               ]);
                           }
                           else
                           {
                               $this->dispatchBrowserEvent('message', [
                                   'text' => 'Only'.$this->product->quantity .'Quantity avialable',
                                   'type' => 'error',
                                   'status' => 500
                               ]);
                           }
                       }
                       else
                       {
                           $this->dispatchBrowserEvent('message', [
                               'text' => 'Out off  stock',
                               'type' => 'error',
                               'status' => 500
                           ]);
                       }
                   }
               }
           }
           else
           {
               $this->dispatchBrowserEvent('message', [
                   'text' => 'Product does not exists',
                   'type' => 'error',
                   'status' => 500
               ]);
           }
       }
       else
       {
           $this->dispatchBrowserEvent('message', [
               'text' => 'Please login to add card',
               'type' => 'error',
               'status' => 500
           ]);
       }
    }
}

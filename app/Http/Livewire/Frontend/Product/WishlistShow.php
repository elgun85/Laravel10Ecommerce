<?php

namespace App\Http\Livewire\Frontend\Product;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Wishlist;

class WishlistShow extends Component
{
    public $wishlistcount;

    //wishlistde siyahidan silende yuxarisa wishlist ceminden avtomatik silmek ucun || wishlistAddedUpdated wishlist showda ->delete() sonra yaz $this->emit('wishlistAddedUpdated');
    protected $listeners = ['wishlistAddedUpdated' => 'checkWishlistCount'];


    public function checkWishlistCount()
    {
      if (Auth::check())
      {
      return    $this->wishlistcount=Wishlist::where('user_id',auth()->user()->id)->count();
      }else{
          return $this->wishlistcount=0;
      }


    }
    public function render()
    {
        $this->wishlistcount=$this->checkWishlistCount();
        return view('livewire.frontend.product.wishlist-show',
            [
                'whishlistCount'=>$this->wishlistcount
            ]);
    }
}

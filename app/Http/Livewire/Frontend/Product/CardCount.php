<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CardCount extends Component
{
    public $cardCount;

    protected $listeners=['cardAddedUpdate' => 'checkCardCount'];

    public function checkCardCount()
    {
        if (Auth::check())
        {
       return     $this->cardCount=Cart::where('user_id',Auth::user()->id)->count();
        }
        else
        {
          return  $this->cardCount=0;
        }
    }
    public function render()
    {
        $this->cardCount=$this->checkCardCount();
        return view('livewire.frontend.product.card-count',
            [
                'cartCount'=>$this->cardCount
            ]);
    }
}

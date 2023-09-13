<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public $cat,$products,$brandInputs=[],$priceInput;
    protected $queryString = [
        'brandInputs'=> ['except' => '', 'as' => 'brand'],
        'priceInput'=> ['except' => '', 'as' => 'price']
    ];
    //=> ['except' => '', 'as' => 'brand']  route-da secilien brendin qabagina yazilir


    public function mount($cat)
    {
        $this->cat = $cat;

    }
    public function render()
    {
        $this->products=Product::where('category_id',$this->cat->id)
            ->when($this->brandInputs,function ($q)
            {
                $q->whereIn('brand',$this->brandInputs);
            })
            ->when($this->priceInput=='higntolow',function ($q2){
                $q2->orderBy('selling_price','DESC');
            })
            ->when($this->priceInput=='lowtohign',function ($q2){
                $q2->orderBy('selling_price','ASC');
            })
            ->where('status',0)->get();
        return view('livewire.frontend.product.index',
            [
                'cat'=>$this->cat,
                'product'=>$this->products
                ]);
    }
}

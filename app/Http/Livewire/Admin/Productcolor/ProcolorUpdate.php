<?php

namespace App\Http\Livewire\Admin\Productcolor;


use App\Models\Product;
use Livewire\Component;

class ProcolorUpdate extends Component
{
public $colqun;
public $col_id;



public function ProductColorUpdate($prodColor_id)
{
    $product=Product::findOrFail($this->col_id)
        ->ProductColor()
        ->where('color_id',$prodColor_id);
    $product->update([
        'Color_quantity'=>$this->colqun
    ]);
}
public function ProductColorDelete($prodColor_id)
{
      $product=Product::findOrFail($this->col_id)
      ->ProductColor()
      ->where('color_id',$prodColor_id);
        $product->delete();
        session()->flash('message','Color Deleted Succesfully');
        //redirect()->with('message','Color Deleted Succesfully');
}


    public function render()
    {

$products=Product::findOrFail($this->col_id);


        return view('livewire.admin.productcolor.procolor-update',compact('products'));
    }
}

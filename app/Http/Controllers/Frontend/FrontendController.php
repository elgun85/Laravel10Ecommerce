<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
/*    public function __construct()
    {
       $this->kat=Category::where('status',0)->paginate(8);
    }*/

    public function index()
    {
        $Sliders=Slider::where('status',0)->get();
        $kat=Category::where('status',0)->paginate(8);

        return view('frontend.index',compact('Sliders','kat'));
    }

    public function product($category_slug)
    {
        $kat=Category::where('status',0)->paginate(8);

        $cat=Category::where('slug',$category_slug)->first();
        if ($cat)
        {
           // $products=$cat->product()->get();

        }else{
            return redirect()->back();
        }

        return view('frontend.product',compact('kat','cat'));

    }

    public function product_view($cat_slug,$prod_slug)
    {
        $kat=Category::where('status',0)->paginate(8);
//return $prod_slug;
        $cat=Category::where('slug',$cat_slug)->first();
        if ($cat)
        {
        $product=$cat->product()->where('name',$prod_slug)->where('status',0)->first();
            if ($product)
            {
                return view('frontend.productView',compact('kat','cat','product'));
            }
            else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }


    }

    public function wishlist()
        {
            $kat=Category::where('status',0)->paginate(8);
        return    view('frontend.wishlist',compact('kat'));
        }

    public function testpage()
    {

      return  view('frontend.test');
    }
}

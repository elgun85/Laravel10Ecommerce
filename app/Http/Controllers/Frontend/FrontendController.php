<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $Sliders=Slider::where('status',0)->get();
        $categories=Category::where('status',0)->paginate(8);

        return view('frontend.index',compact('Sliders','categories'));
    }

    public function product($category_slug)
    {
        $categories=Category::where('status',0)->paginate(8);

        $cat=Category::where('slug',$category_slug)->first();
        if ($cat)
        {
            $products=$cat->product()->get();

        }else{
            return redirect()->back();
        }

        return view('frontend.product',compact('categories','products','cat'));

    }

    public function product_view($cat_slug,$prod_name)
    {
      //  return 'product_view';
     //  $categories=Category::where('status',0)->paginate(8);
    }

/*    public function category()
    {
        $categories=Category::where('status',0)->get();
        return view('')
    }*/
}

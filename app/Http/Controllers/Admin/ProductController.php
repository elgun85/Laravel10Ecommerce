<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::orderBy('id','DESC')->paginate(7);

        return view('backend.Product.Product_index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        $brands=Brand::all();
        return view('backend.Product.Product_create',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $request)
    {
        $validateData=$request->validated();
        $category=Category::findOrFail($validateData['category_id']);
        if ($category)
        {
            $request->merge([
                'slug' => Str::slug($request->name)
            ]);
            $request->merge([
                'trending' => $request->trending== true ? '1':'0',
            ]);
            $request->merge([
                'status' => $request->status== true ? '1':'0',
            ]);

            $product=$category->product()->create($request->post());

            if ($request->hasFile('image'))
            {
                $uploadPath='uploads/product/';
                $i=1;
                foreach ($request->file('image') as $imageFile){
                    $extention = $imageFile->getClientOriginalExtension();
                    $filename=time().$i++.'.'.$extention;
                    $imageFile->move($uploadPath,$filename);
                    $finalImagePathName=$uploadPath.$filename;

                    $product->productImages()->create([
                        'product_id' =>$product->id,
                        'image'       =>$finalImagePathName,
                    ]);
                }
            }


            return redirect()->route('product.index')->with('message','Product ' .$product->name.'   added Successfully');
        }
        else{
            return redirect()->route('product.index')->with('error','Product ' . $product->name.'  no added Successfully');
        }

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories=Category::get();
        $brands=Brand::get();
        $products=Product::findOrFail($id);
        return view('backend.Product.Product_edit',compact('categories','brands','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductFormRequest $request, string $id)
    {
     //   return dd($request->post());
//return $id;

        $validateData=$request->validated();
//dd($request->post());
          $product=Category::findOrFail($validateData['category_id'])->product()->where('id',$id)->first()  ;
   //   return $product=Product::findOrFail($id);
        if ($product)
        {
            $request->merge([
                'slug' => Str::slug($request->name)
            ]);
            $request->merge([
                'trending' => $request->trending== true ? '1':'0',
            ]);
            $request->merge([
                'status' => $request->status== true ? '1':'0',
            ]);
            $product->update($request->post());


            if ($request->hasFile('image'))
            {
                $uploadPath='uploads/product/';
                $i=1;
                foreach ($request->file('image') as $imageFile){
                    $extention = $imageFile->getClientOriginalExtension();
                    $filename=time().$i++.'.'.$extention;
                    $imageFile->move($uploadPath,$filename);
                    $finalImagePathName=$uploadPath.$filename;

                    $product->productImages()->create([
                        'product->id' =>$product->id,
                        'image'       =>$finalImagePathName,
                    ]);
                }
            }


            return redirect()->route('product.index')->with('message','Product  updated Successfully');
        }
        else{
            return redirect()->route('product.index')->with('error','Product no updated ');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function ProductImageDel($id)
    {
        $ProductImageDel=Product_Image::findOrFail($id);
        if (File::exists($ProductImageDel->image)) {

            File::delete($ProductImageDel->image);
        }
        if ($ProductImageDel)
        {
            $ProductImageDel->delete();
            return redirect()->back()->with('message','Product image deleted Successfully');
        }else{
            return redirect()->back()->with('error','Product  image no deleted ');
        }


    }

    public function destroy(string $id)
    {

    }

    public function delete($id)
    {
        $product=Product::findOrFail($id);
        if ($product->productImages)
        {
            foreach ($product->productImages as $image)
            {
                if (File::exists($image->image))
                {
                    File::delete($image->image);
                }
            }
        }
       $delete= $product->delete();
        if ($delete)
        {
            return redirect()->route('product.index')->with('message',' Product ' .$product->name.'  deleted Successfully');
        }else{
            return redirect()->route('product.index')->with('error','Product ' .$product->name.'  no deleted ');
        }



    }
}

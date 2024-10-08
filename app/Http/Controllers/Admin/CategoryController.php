<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

       return view('backend.Category.Category_i');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.Category.Category_c');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request)
    {
        if ($request->hasFile('image'))
        {
            $fileName=str::limit(Str::slug($request->name),10).'_'.rand(99991,9999999).'.'.$request->image->extension();
            $fileUpload='uploads/category/'.$fileName;
            $request->image->move(public_path('uploads/category'),$fileName);
            $request->merge([
                'image'=>$fileUpload
            ]);
        }

        $request->merge([
            'slug' => Str::slug($request->name)
        ]);

        $request->merge([
            'status' => $request->status==true?'1':'0'
        ]);

        Category::create($request->post());

        return redirect()->route('category.index')->with('message','Data added Successfully');
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
        $category=Category::findOrFail($id);
        return view('backend.Category.Category_e',compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryCreateRequest $request, string $id)
    {
        if ($request->hasFile('image'))
        {
            $path = Category::find($id)->image    ;

            if (File::exists($path))
            {
                File::delete($path);
            }

            $fileName=str::limit(Str::slug($request->name),10).'_'.rand(99991,9999999).'.'.$request->image->extension();
            $fileUpload='uploads/category/'.$fileName;
            $request->image->move(public_path('uploads/category'),$fileName);
            $request->merge([
                'image'=>$fileUpload
            ]);
        }

        $request->merge([
            'slug' => Str::slug($request->name)
        ]);

        $request->merge([
            'status' => $request->status==true?'1':'0'
        ]);

        $category=Category::findOrFail($id)->update($request->post());

        return redirect()->route('category.index')->with('message','Data updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

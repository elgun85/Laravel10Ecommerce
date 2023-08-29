<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders=Slider::orderBy('id','DESC')->paginate(5);
        return view('backend.Slider.Slider_i',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.Slider.Slider_c');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderFormRequest $request)
    {
        if ($request->hasFile('image'))
        {
            $fileName=str::limit(Str::slug($request->name),10).'_'.rand(99991,9999999).'.'.$request->image->extension();
            $fileUpload='uploads/slider/'.$fileName;
            $request->image->move(public_path('uploads/slider'),$fileName);
            $request->merge([
                'image'=>$fileUpload
            ]);
        }


        $request->merge([
            'status' => $request->status==true?'1':'0'
        ]);

       $data= Slider::create($request->post());
       if ($data){
           return redirect()->route('slider.index')->with('message','Data added Successfully');
       }else{
           return redirect()->route('slider.index')->with('error','Data no added ');
       }
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

        $slider=Slider::findOrFail($id);
        return view('backend.Slider.Slider_e',compact('slider'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderFormRequest $request, string $id)
    {
        if ($request->hasFile('image'))
        {
            $path = Slider::find($id)->image;

            if (File::exists($path))
            {
                File::delete($path);
            }

            $fileName=str::limit(Str::slug($request->name),10).'_'.rand(99991,9999999).'.'.$request->image->extension();
            $fileUpload='uploads/slider/'.$fileName;
            $request->image->move(public_path('uploads/slider'),$fileName);
            $request->merge([
                'image'=>$fileUpload
            ]);
        }


        $request->merge([
            'status' => $request->status==true?'1':'0'
        ]);

        $data=Slider::findOrFail($id)->update($request->post());
        return redirect()->route('slider.index')->with('message','Data updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete($id)
    {
        $data=Slider::findOrFail($id);
        if (File::exists($data->image)) {

            File::delete($data->image);
        }
        $data->delete();
        return redirect()->route('slider.index')->with('message','Data deleted Successfully');
    }
}

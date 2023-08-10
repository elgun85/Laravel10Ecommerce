<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors=Color::orderBy('id','DESC')->paginate(3);
        return view('backend.Color.Color_index',compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorFormRequest $request)
    {
        if ($request->post()){
            $request->merge([
                'status' => $request->status== true ? '1':'0',
            ]);
            $color=Color::create($request->post());
        }else{
            return redirect()->back()->with('error',"No Added Color ");
        }

        return redirect()->route('color.index')->with('message',"Added Color Successfully");
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
        $color=Color::findOrFail($id);
        $colors=Color::orderBy('id','DESC')->paginate(3);
        return view('backend.Color.Color_update',compact('color','colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColorFormRequest $request, string $id)
    {
        $colors=Color::findOrFail($id);
        if ($colors){
            $request->merge([
                'status' => $request->status== true ? '1':'0',
            ]);
            $update=$colors->update($request->post());
        }else{
            return redirect()->back()->with('error'," Color No Uptaded ");
        }

        return redirect()->route('color.index')->with('message',"Color Uptaded Successfully");
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
        $color=Color::findOrFail($id)->delete();
        return redirect()->route('color.index')->with('message','Colors deleted Successfully');

    }
}

<?php

namespace App\Http\Livewire\Admin\Test;

use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;


class Test extends Component
{
    use WithFileUploads;


    public $name;
    public $title;
    public $images = [];
    public $updadeMode=false;
    public $selected_id;


        public $rules=[
    'images' => 'nullable',
    'name'=>'required|string|max:250',
    'title'=>'nullable|string|max:250',
        ];

        public $messages=[
            'name.required'=>'Name xanasi vacibdir'
        ];


    public function addTest()
    {
$this->validate();


        foreach ($this->images as $key=>$image){
            $this->images[$key]=$image->store('Fotom','public');
        }
        $this->images=json_encode($this->images);
        $new= \App\Models\Test::create([
            'images'=>$this->images,
            'name'=>$this->name,
            'title'=>$this->title
    ]);
        if ($new)
        {
            session()->flash('message','Succesfully');
        }else{
            session()->flash('message','No Succesfully');
        }

    }

    public function editTest($id)
    {
        if ($id)
        {
            $data=\App\Models\Test::findOrFail($id);

            $this->name=$data->name;
            $this->title=$data->title;
            $this->updadeMode=true;
            $this->selected_id=$data->id;
        }

    }

    public function updateData()
    {
        $data=\App\Models\Test::findOrFail($this->selected_id)->update([
            'name'=>$this->name,
            'title'=>$this->title

        ]);

        if ($data)
        {
            session()->flash('message','Updated');
        }else{
            session()->flash('message','No Succesfully');
        }

    }

    public function deleteTest($id)
    {
        if ($id)
        {
            $data=\App\Models\Test::findOrFail($id);
            //dd($data);
            $path=$data->images;
            if (File::exists($path))
            {
                File::delete($path);
            }
            $data->delete();

                session()->flash('message','Deleted');

        }
        else{
            session()->flash('message','No Deleted');
        }
    }




    public function render()
    {

        $test=\App\Models\Test::orderBy('id','DESC')->get();
        return view('livewire.admin.test.test',compact('test'));
    }
}

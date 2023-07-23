<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class BrandIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name,$slug,$status,$brand_id;

    public function rules()
    {
        return[
            'name'=>'required|string|min:3|max:250',
            'slug'=>'required|string|min:3|max:250',
            'status'=>'nullable'
        ];
    }

    public function resetInput()
    {
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        $this->brand_id = NULL;
    }

    public function createBrand()
    {

$validatedData=$this->validate();
Brand::create([
   'name'=>$this->name,
   'slug'=>Str::slug($this->slug),
   'status'=>$this->status ==true ? '1':'0'
]);
session()->flash('message','Brand Added Succesfully');
        $this->emit('close-modal');
        $this->resetInput();

    }

    public function closeModel()
    {
        $this->resetInput();
    }
    public function openModel()
    {
        $this->resetInput();
    }
    public function editBrand($brand_id)
    {
        $this->brand_id=$brand_id;
        $brand=Brand::findOrFail($brand_id);
        $this->name=$brand->name;
        $this->slug=$brand->slug;
        $this->status=$brand->status;
    }

    public function updateBrand()
    {
        $validatedData=$this->validate();
        Brand::findOrFail($this->brand_id)->update([
            'name'=>$this->name,
            'slug'=>Str::slug($this->slug),
            'status'=>$this->status ==true ? '1':'0'
        ]);
        session()->flash('message','Brand Upated Succesfully');
        $this->emit('close-modal');
        $this->resetInput();
    }
    public function deleteBrand($brand_id)
    {
        $this->brand_id=$brand_id;
    }

    public function destroyBrand()
    {
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message','Brand Deleted Succesfully');
        $this->emit('close-modal');
        $this->resetInput();
    }
    public function render()
    {
        $brands=Brand::orderBy('id','DESC')->paginate(5);
        return view('livewire.admin.brand.brand-index',compact('brands'));
    }
}

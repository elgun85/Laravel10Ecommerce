<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $category_id;

    public function deleteCategory($category_id)
    {

$this->category_id = $category_id;
    }

    public function destroyCategory()
    {
        $category=Category::find($this->category_id);


        $path = $category->image    ;

        if (File::exists($path))
        {
            File::delete($path);
        }
        $category->delete();

        $this->emit('close-modal');
        return redirect()->with('message','Data Deleted Successfully');
       // $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $categories=Category::orderBy('id','DESC')->paginate(10);
        return view('livewire.admin.category.category-index',compact('categories'));
    }
}

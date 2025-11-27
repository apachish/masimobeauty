<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class Index extends Component
{


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $child_cat_id = Category::where('parent_id', $id)->pluck('id');

        $status = $category->delete();

        if ($status && $child_cat_id->count() > 0) {
            Category::shiftChild($child_cat_id);
        }



        if ($status) {
            session()->flash('success', 'Category successfully deleted');
        } else {
            session()->flash('error', 'Error while deleting category');
        }

    }

    public function render()
    {
        $categories = Category::getAllCategory();

        return view('livewire.admin.category.index',compact('categories'))
            ->layout('layouts.admin', ['title' => 'E-SHOP || Category Page']);
    }
}

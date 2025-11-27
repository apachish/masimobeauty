<?php

namespace App\Livewire\Admin\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\Component;

class Edit extends Component
{
    public $brands;
    public $product;
    public $categories;
    public $items;
    public $editable;
    public function mount($product)
    {
        $this->product = Product::findOrFail($product);
        $this->brands = Brand::get();
        $this->categories = Category::where('is_parent', 1)->get();
        $this->items = Product::where('id', $product)->get();
        $this->editable = [
            "title"=>data_get($this->product,'title'),
            "summary"=>data_get($this->product,'summary'),
            "description"=>data_get($this->product,'description'),
            "photo"=>data_get($this->product,'photo'),
            "size"=>data_get($this->product,'size'),
            "stock"=>data_get($this->product,'stock'),
            "cat_id"=>data_get($this->product,'cat_id'),
            "child_cat_id"=>data_get($this->product,'child_cat_id'),
            "is_featured"=>data_get($this->product,'is_featured'),
            "brand_id"=>data_get($this->product,'brand_id'),
            "status"=>data_get($this->product,'status'),
            "condition"=>data_get($this->product,'condition'),
            "price"=>data_get($this->product,'price'),
            "discount"=>data_get($this->product,'discount'),
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {

        $this->validate([
            'editable.title' => 'required|string',
            'editable.summary' => 'required|string',
            'editable.description' => 'nullable|string',
            'editable.photo' => 'required|string',
            'editable.size' => 'nullable',
            'editable.stock' => 'required|numeric',
            'editable.cat_id' => 'required|exists:categories,id',
            'editable.child_cat_id' => 'nullable|exists:categories,id',
            'editable.is_featured' => 'sometimes|in:1',
            'editable.brand_id' => 'nullable|exists:brands,id',
            'editable.status' => 'required|in:active,inactive',
            'editable.condition' => 'required|in:default,new,hot',
            'editable.price' => 'required|numeric',
            'editable.discount' => 'nullable|numeric',
        ]);

        $this->editable['is_featured'] = data_get($this->editable,'is_featured', 0);

        if (data_get($this->editable,'size')) {
            $this->editable['size'] = implode(',', data_get($this->editable,'size'));
        } else {
            $this->editable['size'] = '';
        }

        $status = $this->product->update($this->editable);

        $message = $status
            ? 'Product Successfully updated'
            : 'Please try again!!';

        return redirect()->route('product.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }

    public function render()
    {

        return view('livewire.admin.product.edit')->layout('layouts.admin', ['title' => 'E-SHOP || Product Edit']);
    }
}

<?php

namespace App\Livewire\Admin\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\Component;

class Create extends Component
{
    public $product = [
        "title"=>null,
        "summary"=>null,
        "description"=>null,
        "photo"=>null,
        "size"=>null,
        "stock"=>null,
        "cat_id"=>null,
        "brand_id"=>null,
        "child_cat_id"=>null,
        "is_featured"=>false,
        "status"=>"inactive",
        "condition"=>null,
        "price"=>null,
        "discount"=>null,
    ];
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate([
            'product.title' => 'required|string',
            'product.summary' => 'required|string',
            'product.description' => 'nullable|string',
            'product.photo' => 'required|string',
            'product.size' => 'nullable',
            'product.stock' => 'required|numeric',
            'product.cat_id' => 'required|exists:categories,id',
            'product.brand_id' => 'nullable|exists:brands,id',
            'product.child_cat_id' => 'nullable|exists:categories,id',
            'product.is_featured' => 'sometimes|in:1',
            'product.status' => 'required|in:active,inactive',
            'product.condition' => 'required|in:default,new,hot',
            'product.price' => 'required|numeric',
            'product.discount' => 'nullable|numeric',
        ]);

        $slug = generateUniqueSlug(data_get($this->product,'title'), Product::class);
        $this->product['slug'] = $slug;
        $this->product['is_featured'] = data_get($this->product,'is_featured', 0);

        if (data_get($this->product,'size')) {
            $this->product['size'] = implode(',', data_get($this->product,'size'));
        } else {
            $this->product['size'] = '';
        }

        $product = Product::create($this->product);

        $message = $product
            ? 'Product Successfully added'
            : 'Please try again!!';

        return redirect()->route('product.index')->with(
            $product ? 'success' : 'error',
            $message
        );
    }

    public function render()
    {

        $brands = Brand::get();
        $categories = Category::where('is_parent', 1)->get();
        return view('livewire.admin.product.create',compact('brands','categories'))
            ->layout('layouts.admin', ['title' => 'E-SHOP || Product Create']);

    }
}

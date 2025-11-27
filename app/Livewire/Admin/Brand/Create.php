<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use Illuminate\Http\Request;
use Livewire\Component;

class Create extends Component
{
    public $brand = [
        'title'=>null,
        "status"=>'active'
    ];

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate([
            'brand.title' => 'required|string',
            'brand.status' => 'required|in:active,inactive',
        ]);

        $slug = generateUniqueSlug(data_get($this->brand,'title'), Brand::class);

        $this->brand['slug'] = $slug;

        $brand = Brand::create($this->brand);

        $message = $brand
            ? 'Brand successfully created'
            : 'Error, Please try again';

        return redirect()->route('brand.index')->with(
            $brand ? 'success' : 'error',
            $message
        );
    }


    public function render()
    {
        return view('livewire.admin.brand.create') ->layout('layouts.admin', ["title" => 'E-SHOP || Brand Create' ]);
    }
}

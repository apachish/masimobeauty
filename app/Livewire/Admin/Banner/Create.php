<?php

namespace App\Livewire\Admin\Banner;

use App\Models\Banner;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{

    public $banner = [
        'title' => '',
        'description' => '',
        'photo' => '',
        'status'=>'inactive'
    ];


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save()
    {
        $this->validate([
            'banner.title' => 'required|string|max:50',
            'banner.description' => 'nullable|string',
            'banner.photo' => 'required|string',
            'banner.status' => 'required|in:active,inactive',
        ]);

        $slug = $this->generateUniqueSlug(data_get($this->banner, 'title'));
        $this->banner['slug'] = $slug;

        $banner = Banner::create($this->banner);

        $message = $banner
            ? 'Banner successfully added'
            : 'Error occurred while adding banner';

        return redirect()->route('banner.index')->with(
            $banner ? 'success' : 'error',
            $message
        );
    }
    public function render()
    {
        return view('livewire.admin.banner.create')->layout('layouts.admin', ['title' => 'E-SHOP || Banner Create']);
    }

    /**
     * Generate a unique slug for the banner.
     *
     * @param  string  $title
     * @return string
     */
    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = Banner::where('slug', $slug)->count();

        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }

        return $slug;
    }
}

<?php

namespace App\Livewire\Admin\PostCategory;

use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{

    public $post_category = [
        "title"=>null,
        "status"=>"inactive",
    ];
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate([
            'post_category.title'=>'string|required',
            'post_category.status'=>'required|in:active,inactive'
        ]);
        $slug=Str::slug(data_get($this->post_category, 'title'));
        $count=PostCategory::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $this->post_category['slug']=$slug;
        $status=PostCategory::create( $this->post_category);
        if($status){
            request()->session()->flash('success','Post Category Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('post-category.index');
    }

    public function render()
    {
        return view('livewire.admin.post-category.create')
            ->layout('layouts.admin', ['title' => 'E-SHOP || ٍCreate Category Post Page']);

    }
}

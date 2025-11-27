<?php

namespace App\Livewire\Admin\Posttag;

use App\Models\PostTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    public $tag = [
        'title' => null,
        "status"=>"inactive"
    ];
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate([
            'tag.title'=>'string|required',
            'tag.status'=>'required|in:active,inactive'
        ]);
        $slug=Str::slug(data_get($this->tag,'title'));
        $count=PostTag::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $this->tag['slug']=$slug;
        $status=PostTag::create($this->tag);
        if($status){
            request()->session()->flash('success','Post Tag Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('post-tag.index');
    }

    public function render()
    {
        return view('livewire.admin.posttag.create')
            ->layout('layouts.admin', ['title' => 'E-SHOP || ٍCreate Tag Post Page']);
    }
}

<?php

namespace App\Livewire\Admin\Post;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    public $post = [
        "title"=>null,
        "quote"=>null,
        "summary"=>null,
        "description"=>null,
        "photo"=>null,
        "tags"=>null,
        "added_by"=>null,
        "post_cat_id"=>null,
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
            'post.title'=>'string|required',
            'post.quote'=>'string|nullable',
            'post.summary'=>'string|required',
            'post.description'=>'string|nullable',
            'post.photo'=>'string|nullable',
            'post.tags'=>'nullable',
            'post.added_by'=>'nullable',
            'post.post_cat_id'=>'required',
            'post.status'=>'required|in:active,inactive'
        ]);


        $slug=Str::slug(data_get($this->post,'title'));
        $count=Post::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data=$this->post;
        $data['slug']=$slug;

        $tags= data_get($this->post,'tags');
        if($tags){
            $data['tags']=implode(',',$tags);
        }
        else{
            $data['tags']='';
        }

        $status = Post::create($data);
        if($status){
            session()->flash('success','Post Successfully added');
        }
        else{
            session()->flash('error','Please try again!!');
        }
        return redirect()->route('post.index');
    }

    public function render()
    {
        $categories=PostCategory::get();
        $tags=PostTag::get();
        $users=User::get();
        return view('livewire.admin.post.create',compact('categories','tags','users'))
            ->layout('layouts.admin', ['title' => 'E-SHOP || ٍCreate Post Page']);
    }
}

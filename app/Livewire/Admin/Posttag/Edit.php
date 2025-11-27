<?php

namespace App\Livewire\Admin\Posttag;

use App\Models\PostTag;
use Illuminate\Http\Request;
use Livewire\Component;

class Edit extends Component
{
    public Posttag $tag;
    public $editable ;
    public function mount($tag){
        $this->tag = $tag;
        if(!$this->tag) abort(404);
        $this->editable = [
            "title"=>$this->tag->title,
            "status"=>$this->tag->status,
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        // return $request->all();
        $this->validate([
            'editable.title'=>'string|required',
            'editable.status'=>'required|in:active,inactive'
        ]);
        $status= $this->tag->update($this->editable);
        if($status){
            request()->session()->flash('success','Post Tag Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('post-tag.index');
    }


    public function render()
    {
        return view('livewire.admin.posttag.edit')
            ->layout('layouts.admin', ['title' => 'E-SHOP || Edit Tag Post Page']);
    }
}

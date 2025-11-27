<?php

namespace App\Livewire\Admin\Banner;

use App\Models\Banner;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return void
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $status = $banner->delete();

        if ($status) {
            session()->flash('success', 'Banner successfully deleted');
        } else {
            session()->flash('error', 'Error occurred while deleting banner');
    }
    }

    public function render()
    {
        $banners = Banner::latest('id')->paginate(10);

        return view('livewire.admin.banner.index',compact('banners'))
            ->layout('layouts.admin', ['title' => 'E-SHOP || Banner Page']);
    }
}

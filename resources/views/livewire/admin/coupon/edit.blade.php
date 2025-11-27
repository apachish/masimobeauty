<div class="card">
    <h5 class="card-header">Edit Coupon</h5>
    <div class="card-body">
      <form wire:submit.prevent="update">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Coupon Code <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" wire:model="editable.code" placeholder="Enter Coupon Code"  value="{{$coupon->code}}" class="form-control">
          @error('editable.code')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>

          <div class="form-group">
              <label for="type" class="col-form-label">Type <span class="text-danger">*</span></label>
              <select wire:model="editable.type" class="form-control">
                  <option value="fixed" {{(($coupon->type=='fixed') ? 'selected' : '')}}>Fixed</option>
                  <option value="percent" {{(($coupon->type=='percent') ? 'selected' : '')}}>Percent</option>
              </select>
              @error('editable.type')
              <span class="text-danger">{{$message}}</span>
              @enderror
          </div>

          <div class="form-group">
              <label for="inputTitle" class="col-form-label">Value <span class="text-danger">*</span></label>
              <input id="inputTitle" type="number" wire:model="editable.value" placeholder="Enter Coupon value"  value="{{$coupon->value}}" class="form-control">
              @error('editable.value')
              <span class="text-danger">{{$message}}</span>
              @enderror
          </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select wire:model="editable.status" class="form-control">
            <option value="active" {{(($coupon->status=='active') ? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($coupon->status=='inactive') ? 'selected' : '')}}>Inactive</option>
          </select>
          @error('editable.status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>
@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });
</script>
@endpush

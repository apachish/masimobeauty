<div class="card">
    <h5 class="card-header">Add Brand</h5>
    <div class="card-body">
      <form wire:submit.prevent="store">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" wire:model="brand.title" placeholder="Enter title"  class="form-control">
        @error('brand.title')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select wire:model="brand.status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          @error('brand.status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
</div>
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

@endpush

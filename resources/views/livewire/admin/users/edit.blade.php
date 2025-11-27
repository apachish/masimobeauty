<div class="card">
    <h5 class="card-header">Edit User</h5>
    <div class="card-body">
      <form wire:submit.prevent="update">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Name</label>
        <input id="inputTitle" type="text" wire:model="editable.name" placeholder="Enter name"  value="{{$user->name}}" class="form-control">
        @error('editable.name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="inputEmail" class="col-form-label">Email</label>
          <input id="inputEmail" type="email" wire:model="editable.email" placeholder="Enter email"  value="{{$user->email}}" class="form-control">
          @error('editable.email')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        {{-- <div class="form-group">
            <label for="inputPassword" class="col-form-label">Password</label>
          <input id="inputPassword" type="password" wire:model="editable.password" placeholder="Enter password"  value="{{$user->password}}" class="form-control">
          @error('editable.password')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div> --}}

        <div class="form-group">
        <label for="inputPhoto" class="col-form-label">Photo</label>
        <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Choose
                </a>
            </span>
            <input id="thumbnail" class="form-control" type="text" wire:model="editable.photo">
        </div>
        <img id="holder" style="margin-top:15px;max-height:100px;">
          @error('editable.photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
            <label for="role" class="col-form-label">Role</label>
            <select wire:model="editable.role" class="form-control">
                <option value="">-----Select Role-----</option>
                    <option value="admin" >Admin</option>
                    <option value="user">User</option>
            </select>
          @error('editable.role')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>
          <div class="form-group">
            <label for="status" class="col-form-label">Status</label>
            <select wire:model="editable.status" class="form-control">
                <option value="active" {{(($user->status=='active') ? 'selected' : '')}}>Active</option>
                <option value="inactive" {{(($user->status=='inactive') ? 'selected' : '')}}>Inactive</option>
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
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize file manager
        $('#lfm').filemanager('image');

        // Sync Laravel File Manager value with Livewire
        const thumbnailInput = document.getElementById('thumbnail');
        if (thumbnailInput) {
            // Function to sync value with Livewire
            function syncWithLivewire() {
                const value = thumbnailInput.value;
                if (value) {
                    @this.set('editable.photo', value);
                }
            }

            // Listen for input events (when user types)
            thumbnailInput.addEventListener('input', syncWithLivewire);

            // Listen for change events (when Laravel File Manager sets value)
            thumbnailInput.addEventListener('change', syncWithLivewire);

            // Watch for value changes (for Laravel File Manager - more reliable)
            let lastValue = thumbnailInput.value;
            const checkValue = setInterval(function() {
                const currentValue = thumbnailInput.value;
                if (currentValue !== lastValue) {
                    lastValue = currentValue;
                    syncWithLivewire();
                }
            }, 200);

            // Also listen for DOMSubtreeModified (for older browsers)
            if (window.MutationObserver) {
                const observer = new MutationObserver(function(mutations) {
                    syncWithLivewire();
                });
                observer.observe(thumbnailInput, {
                    attributes: true,
                    attributeFilter: ['value'],
                    childList: false,
                    subtree: false
                });
            }
        }
    })
</script>
@endpush

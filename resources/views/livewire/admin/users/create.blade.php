<div class="card">
    <h5 class="card-header">Add User</h5>
    <div class="card-body">
      <form wire:submit.prevent="store">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Name</label>
        <input id="inputTitle" type="text" wire:model="user.name" placeholder="Enter name"  value="{{old('name')}}" class="form-control">
        @error('user.name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="inputEmail" class="col-form-label">Email</label>
          <input id="inputEmail" type="email" wire:model="user.email" placeholder="Enter email"  value="{{old('email')}}" class="form-control">
          @error('user.email')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
            <label for="inputPassword" class="col-form-label">Password</label>
          <input id="inputPassword" type="password" wire:model="user.password" placeholder="Enter password"  value="{{old('password')}}" class="form-control">
          @error('user.password')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
        <label for="inputPhoto" class="col-form-label">Photo</label>
        <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Choose
                </a>
            </span>
            <input id="thumbnail" class="form-control" type="text" wire:model="user.photo" value="{{old('photo')}}">
        </div>
        <img id="holder" style="margin-top:15px;max-height:100px;">
          @error('user.photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
            <label for="role" class="col-form-label">Role</label>
            <select wire:model="user.role" class="form-control">
                <option value="">-----Select Role-----</option>
                <option value="admin" >Admin</option>
                <option value="user">User</option>
            </select>
          @error('user.role')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>
          <div class="form-group">
            <label for="status" class="col-form-label">Status</label>
            <select wire:model="user.status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
          @error('user.status')
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
                @this.set('user.photo', value);
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

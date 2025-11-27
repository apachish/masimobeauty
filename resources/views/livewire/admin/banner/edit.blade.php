
<div class="card">
    <h5 class="card-header">Edit Banner</h5>
    <div class="card-body">
      <form wire:submit.prevent="update">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" wire:model.blur="editable.title" placeholder="Enter title" class="form-control">
        @error('editable.title')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group" wire:ignore>
          <label for="inputDesc" class="col-form-label">Description</label>
          <textarea class="form-control" id="description"></textarea>
          @error('editable.description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
        <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Choose
                </a>
            </span>
          <input id="thumbnail" class="form-control" type="text" wire:model="editable.photo" wire:key="photo-input">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('editable.photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select wire:model.blur="editable.status" class="form-control">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize file manager
    $('#lfm').filemanager('image');

        // Sync Laravel File Manager value with Livewire
        const thumbnailInput = document.getElementById('thumbnail');
        if (thumbnailInput) {
            // Set initial value from Livewire
            const initialValue = @this.get('editable.photo') || '';
            if (initialValue && !thumbnailInput.value) {
                thumbnailInput.value = initialValue;
            }

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

            // Clean up on page unload
            window.addEventListener('beforeunload', function() {
                clearInterval(checkValue);
            });
        }

        // Store Summernote content
        let summernoteContent = '';
        
        // Initialize Summernote function
        function initSummernote() {
            const $textarea = $('#description');
            
            if (!$textarea.length) {
                return;
            }
            
            // Check if already initialized
            if ($textarea.next('.note-editor').length) {
                // Already initialized, preserve content
                return;
            }
            
            // Get saved content or from Livewire
            const contentToSet = summernoteContent || @this.get('editable.description') || '';
            
            // Initialize Summernote
            $textarea.summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
                height: 150,
                callbacks: {
                    onChange: function(contents, $editable) {
                        summernoteContent = contents;
                        @this.set('editable.description', contents);
                    }
                }
            });
            
            // Set content after initialization
            if (contentToSet) {
                setTimeout(function() {
                    $textarea.summernote('code', contentToSet);
                    summernoteContent = contentToSet;
                }, 100);
            }
        }

        // Initialize Summernote on page load
        setTimeout(function() {
            initSummernote();
        }, 300);

        // Save content before Livewire updates
        Livewire.hook('message.sent', (message, component) => {
            const $textarea = $('#description');
            if ($textarea.length && $textarea.next('.note-editor').length) {
                try {
                    const content = $textarea.summernote('code');
                    if (content) {
                        summernoteContent = content;
                        @this.set('editable.description', content);
                    }
                } catch(e) {
                    // Ignore
                }
            }
        });

        // Re-initialize after Livewire updates (preserve content)
        Livewire.hook('message.processed', (message, component) => {
            setTimeout(function() {
                const $textarea = $('#description');
                if ($textarea.length) {
                    // If Summernote exists, preserve it
                    if ($textarea.next('.note-editor').length) {
                        // Already exists, just sync content
                        if (summernoteContent) {
                            const currentContent = $textarea.summernote('code') || '';
                            if (currentContent !== summernoteContent) {
                                $textarea.summernote('code', summernoteContent);
                            }
                        }
                    } else {
                        // Re-initialize
                        initSummernote();
                    }
                }
            }, 300);
    });
    });
</script>
@endpush

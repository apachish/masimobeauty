<div class="card">
    <h5 class="card-header">Add Category</h5>
    <div class="card-body">
        {{logger("error",[$errors])}}
      <form wire:submit.prevent="store">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" wire:model="category.title" placeholder="Enter title"   class="form-control">
          @error('category.title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">Summary</label>
          <div wire:ignore>
            <textarea class="form-control" id="summary"></textarea>
          </div>
          @error('category.summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="is_parent">Is Parent</label><br>
          <input type="checkbox" wire:model='category.is_parent' id='is_parent' > Yes
            @error('category.is_parent')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        {{-- {{$parent_cats}} --}}

        <div class="form-group d-none" id='parent_cat_div'>
          <label for="parent_id">Parent Category</label>
          <select wire:model="category.parent_id" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($parent_cats as $key=>$parent_cat)
                  <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
              @endforeach
          </select>
            @error('category.parent_id')
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
          <input id="thumbnail" class="form-control" type="text" wire:model="category.photo" >
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>

          @error('category.photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select wire:model="category.status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          @error('category.status')
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

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#is_parent').change(function(){
            var is_checked=$('#is_parent').prop('checked');
            // alert(is_checked);
            if(is_checked){
                $('#parent_cat_div').addClass('d-none');
                $('#parent_cat_div').val('');
            }
            else{
                $('#parent_cat_div').removeClass('d-none');
            }
        })
        // Initialize file manager
        $('#lfm').filemanager('image');

        // Sync Laravel File Manager value with Livewire
        const thumbnailInput = document.getElementById('thumbnail');
        if (thumbnailInput) {
            // Function to sync value with Livewire
            function syncWithLivewire() {
                const value = thumbnailInput.value;
                if (value) {
                @this.set('category.photo', value);
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
        let summernoteInitialized = false;

        // Initialize Summernote function
        function initSummernote() {
            const $textarea = $('#summary');

            if (!$textarea.length) {
                return;
            }

            // Check if already initialized
            if ($textarea.next('.note-editor').length) {
                return;
            }

            // Get content from Livewire or saved content
            const livewireContent = @this.get('category.summary') || '';
            const contentToSet = summernoteContent || livewireContent;

            // Initialize Summernote
            $textarea.summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 150,
                callbacks: {
                    onChange: function(contents, $editable) {
                        summernoteContent = contents;
                        @this.set('category.summary', contents);
                    },
                    onBlur: function() {
                        summernoteContent = $textarea.summernote('code');
                        @this.set('category.summary', summernoteContent);
                    }
                }
            });

            summernoteInitialized = true;

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
            const $textarea = $('#summary');
            if ($textarea.length && $textarea.next('.note-editor').length) {
                try {
                    const content = $textarea.summernote('code');
                    if (content !== null && content !== undefined) {
                        summernoteContent = content;
                        @this.set('category.summary', content);
                    }
                } catch(e) {
                    // Ignore
                }
            }
        });

        // Re-initialize after Livewire updates (preserve content)
        Livewire.hook('message.processed', (message, component) => {
            setTimeout(function() {
                const $textarea = $('#summary');
                if ($textarea.length) {
                    // Destroy existing instance if it exists
                    if ($textarea.next('.note-editor').length) {
                        try {
                            summernoteContent = $textarea.summernote('code');
                            $textarea.summernote('destroy');
                        } catch(e) {
                            // Ignore
                        }
                    }

                    // Re-initialize
                    initSummernote();
                }
            }, 150);
        });
    });

</script>

@endpush

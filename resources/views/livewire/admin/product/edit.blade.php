<div class="card">
    <h5 class="card-header">Edit Product</h5>
    <div class="card-body">
      <form wire:submit.prevent="update">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text"  wire:model="editable.title" placeholder="Enter title"   class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
          <div wire:ignore>
            <textarea class="form-control" id="summary"></textarea>
          </div>
          @error('summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <div wire:ignore>
            <textarea class="form-control" id="description"></textarea>
          </div>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>


        <div class="form-group">
          <label for="is_featured">Is Featured</label><br>
          <input type="checkbox" name='is_featured' id='is_featured' value='{{$product->is_featured}}' {{(($product->is_featured) ? 'checked' : '')}}> Yes
        </div>
              {{-- {{$categories}} --}}

        <div class="form-group">
          <label for="cat_id">Category <span class="text-danger">*</span></label>
          <select  wire:model="editable.cat_id" id="cat_id" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{$cat_data->id}}' {{(($product->cat_id==$cat_data->id)? 'selected' : '')}}>{{$cat_data->title}}</option>
              @endforeach
          </select>
        </div>
        @php
          $sub_cat_info=DB::table('categories')->select('title')->where('id',$product->child_cat_id)->get();
        // dd($sub_cat_info);

        @endphp
        {{-- {{$product->child_cat_id}} --}}
        <div class="form-group {{(($product->child_cat_id)? '' : 'd-none')}}" id="child_cat_div">
          <label for="child_cat_id">Sub Category</label>
          <select  wire:model="editable.child_cat_id" id="child_cat_id" class="form-control">
              <option value="">--Select any sub category--</option>

          </select>
        </div>

        <div class="form-group">
          <label for="price" class="col-form-label">Price(NRS) <span class="text-danger">*</span></label>
          <input id="price" type="number"  wire:model="editable.price" placeholder="Enter price"   class="form-control">
          @error('price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="discount" class="col-form-label">Discount(%)</label>
          <input id="discount" type="number"  wire:model="editable.discount" min="0" max="100" placeholder="Enter discount"   class="form-control">
          @error('discount')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="size">Size</label>
          <select  wire:model="editable.size[]" class="form-control selectpicker"  multiple data-live-search="true">
              <option value="">--Select any size--</option>
              @foreach($items as $item)
                @php
                $data=explode(',',$item->size);
                // dd($data);
                @endphp
              <option value="S"  @if( in_array( "S",$data ) ) selected @endif>Small</option>
              <option value="M"  @if( in_array( "M",$data ) ) selected @endif>Medium</option>
              <option value="L"  @if( in_array( "L",$data ) ) selected @endif>Large</option>
              <option value="XL"  @if( in_array( "XL",$data ) ) selected @endif>Extra Large</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="brand_id">Brand</label>
          <select  wire:model="editable.brand_id" class="form-control">
              <option value="">--Select Brand--</option>
             @foreach($brands as $brand)
              <option value="{{$brand->id}}" {{(($product->brand_id==$brand->id)? 'selected':'')}}>{{$brand->title}}</option>
             @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="condition">Condition</label>
          <select  wire:model="editable.condition" class="form-control">
              <option value="">--Select Condition--</option>
              <option value="default" {{(($product->condition=='default')? 'selected':'')}}>Default</option>
              <option value="new" {{(($product->condition=='new')? 'selected':'')}}>New</option>
              <option value="hot" {{(($product->condition=='hot')? 'selected':'')}}>Hot</option>
          </select>
        </div>

        <div class="form-group">
          <label for="stock">Quantity <span class="text-danger">*</span></label>
          <input id="quantity" type="number"  wire:model="editable.stock" min="0" placeholder="Enter quantity"   class="form-control">
          @error('stock')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                  <i class="fas fa-image"></i> Choose
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text"  wire:model="editable.photo" >
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select  wire:model="editable.status" class="form-control">
            <option value="active" {{(($product->status=='active')? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($product->status=='inactive')? 'selected' : '')}}>Inactive</option>
        </select>
          @error('status')
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{asset('backend/summernote/summernote.min.js')}}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>


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

                // Clean up on page unload
                window.addEventListener('beforeunload', function() {
                    clearInterval(checkValue);
                });
            }

            // Store Summernote content
            let summernoteSummaryContent = @json($product->summary ?? '');
            let summernoteDescriptionContent = @json($product->description ?? '');

            // Initialize Summernote function for summary
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
                const livewireContent = @this.get('editable.summary') || '';
                const contentToSet = summernoteSummaryContent || livewireContent || @json($product->summary ?? '');

                // Initialize Summernote
                $textarea.summernote({
                    placeholder: "Write short description.....",
                    tabsize: 2,
                    height: 150,
                    callbacks: {
                        onChange: function(contents, $editable) {
                            summernoteSummaryContent = contents;
                        @this.set('editable.summary', contents);
                        },
                        onBlur: function() {
                            summernoteSummaryContent = $textarea.summernote('code');
                        @this.set('editable.summary', summernoteSummaryContent);
                        }
                    }
                });

                // Set content after initialization
                if (contentToSet) {
                    setTimeout(function() {
                        $textarea.summernote('code', contentToSet);
                        summernoteSummaryContent = contentToSet;
                    }, 100);
                }
            }

            // Initialize Summernote function for description
            function initSummerDescription() {
                const $textarea = $('#description');

                if (!$textarea.length) {
                    return;
                }

                // Check if already initialized
                if ($textarea.next('.note-editor').length) {
                    return;
                }

                // Get content from Livewire or saved content
                const livewireContent = @this.get('editable.description') || '';
                const contentToSet = summernoteDescriptionContent || livewireContent || @json($product->description ?? '');

                // Initialize Summernote
                $textarea.summernote({
                    placeholder: "Write detail description.....",
                    tabsize: 2,
                    height: 150,
                    callbacks: {
                        onChange: function(contents, $editable) {
                            summernoteDescriptionContent = contents;
                        @this.set('editable.description', contents);
                        },
                        onBlur: function() {
                            summernoteDescriptionContent = $textarea.summernote('code');
                        @this.set('editable.description', summernoteDescriptionContent);
                        }
                    }
                });

                // Set content after initialization
                if (contentToSet) {
                    setTimeout(function() {
                        $textarea.summernote('code', contentToSet);
                        summernoteDescriptionContent = contentToSet;
                    }, 100);
                }
            }

            // Initialize Summernote on page load
            setTimeout(function() {
                initSummernote();
                initSummerDescription();
            }, 300);

            // Save content before Livewire updates
            Livewire.hook('message.sent', (message, component) => {
                const $textarea = $('#summary');
                if ($textarea.length && $textarea.next('.note-editor').length) {
                    try {
                        const content = $textarea.summernote('code');
                        if (content !== null && content !== undefined) {
                            summernoteSummaryContent = content;
                        @this.set('editable.summary', content);
                        }
                    } catch(e) {
                        // Ignore
                    }
                }
                const $textarea_desc = $('#description');
                if ($textarea_desc.length && $textarea_desc.next('.note-editor').length) {
                    try {
                        const content = $textarea_desc.summernote('code');
                        if (content !== null && content !== undefined) {
                            summernoteDescriptionContent = content;
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
                    const $textarea = $('#summary');
                    if ($textarea.length) {
                        // Destroy existing instance if it exists
                        if ($textarea.next('.note-editor').length) {
                            try {
                                summernoteSummaryContent = $textarea.summernote('code');
                                $textarea.summernote('destroy');
                            } catch(e) {
                                // Ignore
                            }
                        }

                        // Re-initialize
                        initSummernote();
                    }
                    const $textarea_description = $('#description');
                    if ($textarea_description.length) {
                        // Destroy existing instance if it exists
                        if ($textarea_description.next('.note-editor').length) {
                            try {
                                summernoteDescriptionContent = $textarea_description.summernote('code');
                                $textarea_description.summernote('destroy');
                            } catch(e) {
                                // Ignore
                            }
                        }

                        // Re-initialize
                        initSummerDescription();
                    }
                }, 150);
            });

        });

    </script>
@endpush


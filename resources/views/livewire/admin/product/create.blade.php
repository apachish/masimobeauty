<div class="card">
    <h5 class="card-header">Add Product</h5>
    <div class="card-body">
      <form wire:submit.prevent="store">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" wire:model="product.title" placeholder="Enter title"   class="form-control">
          @error('product.title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
          <div wire:ignore>
            <textarea class="form-control" id="summary"></textarea>
          </div>
          @error('product.summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <div wire:ignore>
            <textarea class="form-control" id="description"></textarea>
          </div>
          @error('product.description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>


        <div class="form-group">
          <label for="is_featured">Is Featured</label><br>
          <input type="checkbox" wire:model="product.is_featured" id='is_featured'> Yes
        </div>
              {{-- {{$categories}} --}}

        <div class="form-group">
          <label for="cat_id">Category <span class="text-danger">*</span></label>
          <select wire:model="product.cat_id" id="cat_id" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
              @endforeach
          </select>
        </div>

        <div class="form-group d-none" id="child_cat_div">
          <label for="child_cat_id">Sub Category</label>
          <select wire:model="product.child_cat_id" id="child_cat_id" class="form-control">
              <option value="">--Select any category--</option>
              {{-- @foreach($parent_cats as $key=>$parent_cat)
                  <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
              @endforeach --}}
          </select>
        </div>

        <div class="form-group">
          <label for="price" class="col-form-label">Price(NRS) <span class="text-danger">*</span></label>
          <input id="price" type="number" wire:model="product.price" placeholder="Enter price"   class="form-control">
          @error('product.price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="discount" class="col-form-label">Discount(%)</label>
          <input id="discount" type="number" wire:model="product.discount" min="0" max="100" placeholder="Enter discount"   class="form-control">
          @error('product.discount')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="size">Size</label>
          <select wire:model="product.size[]" class="form-control selectpicker"  multiple data-live-search="true">
              <option value="">--Select any size--</option>
              <option value="S">Small (S)</option>
              <option value="M">Medium (M)</option>
              <option value="L">Large (L)</option>
              <option value="XL">Extra Large (XL)</option>
          </select>
        </div>

        <div class="form-group">
          <label for="brand_id">Brand</label>
          {{-- {{$brands}} --}}

          <select wire:model="product.brand_id" class="form-control">
              <option value="">--Select Brand--</option>
             @foreach($brands as $brand)
              <option value="{{$brand->id}}">{{$brand->title}}</option>
             @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="condition">Condition</label>
          <select wire:model="product.condition" class="form-control">
              <option value="">--Select Condition--</option>
              <option value="default">Default</option>
              <option value="new">New</option>
              <option value="hot">Hot</option>
          </select>
        </div>

        <div class="form-group">
          <label for="stock">Quantity <span class="text-danger">*</span></label>
          <input id="quantity" type="number" wire:model="product.stock" min="0" placeholder="Enter quantity"   class="form-control">
          @error('product.stock')
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
          <input id="thumbnail" class="form-control" type="text" wire:model="product.photo" >
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('product.photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select wire:model="product.status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          @error('product.status')
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{asset('backend/summernote/summernote.min.js')}}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#cat_id').change(function(){
                var cat_id=$(this).val();
                // alert(cat_id);
                if(cat_id !=null){
                    // Ajax call
                    $.ajax({
                        url:"/admin/category/"+cat_id+"/child",
                        data:{
                            _token:"{{csrf_token()}}",
                            id:cat_id
                        },
                        type:"POST",
                        success:function(response){
                            if(typeof(response) !='object'){
                                response=$.parseJSON(response)
                            }
                            // console.log(response);
                            var html_option="<option value=''>----Select sub category----</option>"
                            if(response.status){
                                var data=response.data;
                                // alert(data);
                                if(response.data){
                                    $('#child_cat_div').removeClass('d-none');
                                    $.each(data,function(id,title){
                                        html_option +="<option value='"+id+"'>"+title+"</option>"
                                    });
                                }
                                else{
                                }
                            }
                            else{
                                $('#child_cat_div').addClass('d-none');
                            }
                            $('#child_cat_id').html(html_option);
                        }
                    });
                }
                else{
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
                    @this.set('product.photo', value);
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
            let summernoteSummaryContent = '';
            let summernoteDescriptionContent = '';

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
                const livewireContent = @this.get('product.summary') || '';
                const contentToSet = summernoteSummaryContent || livewireContent;

                // Initialize Summernote
                $textarea.summernote({
                    placeholder: "Write short description.....",
                    tabsize: 2,
                    height: 150,
                    callbacks: {
                        onChange: function(contents, $editable) {
                            summernoteSummaryContent = contents;
                        @this.set('product.summary', contents);
                        },
                        onBlur: function() {
                            summernoteSummaryContent = $textarea.summernote('code');
                        @this.set('product.summary', summernoteSummaryContent);
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
                const livewireContent = @this.get('product.description') || '';
                const contentToSet = summernoteDescriptionContent || livewireContent;

                // Initialize Summernote
                $textarea.summernote({
                    placeholder: "Write detail description.....",
                    tabsize: 2,
                    height: 150,
                    callbacks: {
                        onChange: function(contents, $editable) {
                            summernoteDescriptionContent = contents;
                        @this.set('product.description', contents);
                        },
                        onBlur: function() {
                            summernoteDescriptionContent = $textarea.summernote('code');
                        @this.set('product.description', summernoteDescriptionContent);
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
                        @this.set('product.summary', content);
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
                        @this.set('product.description', content);
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

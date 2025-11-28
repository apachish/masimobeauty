<div>
    <!-- New Arrivals -->
    <section class="new-arrivals">
        <div class="container">
            <div class="new-arrivals-content"
                 x-data="{
                     currentSlide: {{ $currentSlide }},
                     totalSlides: {{ ceil(count($arrivals) / 3) }},
                     nextSlide() {
                         if (this.currentSlide < this.totalSlides - 1) {
                             this.currentSlide++;
                         } else {
                             this.currentSlide = 0;
                         }
                         $wire.currentSlide = this.currentSlide;
                     },
                     previousSlide() {
                         if (this.currentSlide > 0) {
                             this.currentSlide--;
                         } else {
                             this.currentSlide = this.totalSlides - 1;
                         }
                         $wire.currentSlide = this.currentSlide;
                     }
                 }">
                <div class="new-arrivals-text">
                    <h2>New Arrivals</h2>
                    <div class="title-decoration">
                        <span class="decoration-line"></span>
                        <img  src="/images/icon-title.png" alt="Decoration" class="decoration-icon"/>
                        <span class="decoration-line"></span>
                    </div>
                    <p>100% authentic products, quick delivery, fast online support, and free gifts almost with every order. We also offer worldwide shipping of Korean cosmetics at affordable rates that depend on the weight.</p>
                    <div class="carousel-controls">
                        <button type="button" class="nav-arrow nav-arrow-left" x-on:click="previousSlide()">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button type="button" class="nav-arrow nav-arrow-right" x-on:click="nextSlide()">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
                <div class="products-carousel-wrapper">
                    <div class="products-carousel"
                         x-bind:style="'transform: translateX(calc(-' + currentSlide + ' * (33.333% + 20px / 3)))'">
                        @foreach($arrivals as $arrival)
                        <div class="product-card" wire:key="product-{{ data_get($arrival,'id') }}">
                            @if(data_get($arrival,'discount'))
                            <div class="discount-badge">-{{data_get($arrival,'discount')}}%</div>
                            @endif
                            <div class="product-img product-img-1">
                                <img src="{{data_get($arrival,'photo')}}" alt="{{data_get($arrival,'title')}}">
                            </div>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="review-count">1</span>
                            </div>
                            <h4>{{data_get($arrival,'title')}}</h4>
                            <div class="price">
                                @if(data_get($arrival,'discount'))
                                    <span class="old-price">${{number_format(data_get($arrival,'price'), 2)}}</span>
                                    <span class="current-price">${{number_format(data_get($arrival,'price')*((100-data_get($arrival,'discount'))/100), 2)}}</span>
                                @else
                                    ${{number_format(data_get($arrival,'price'), 2)}}
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

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
                         x-bind:style="'transform: translateX(calc(-' + currentSlide + ' * ((100% - 40px) / 3 + 20px)))'">
                        @foreach($arrivals as $arrival)
                            <livewire:product-card :product="$arrival" :key="'product-'.data_get($arrival,'id')" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

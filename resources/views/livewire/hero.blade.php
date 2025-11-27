    <section id="Gslider" class="hero owl-carousel owl-theme">
        @foreach($banners as $banner)
            <div class="item">
                <div class="hero-image-wrapper">
                    <img src="{{$banner->photo}}" alt="{{$banner->title}}" class="hero-image">
                </div>
                <div class="hero-content-overlay">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-8">
                                <div class="hero-content-left">
                                    <span class="hero-subtitle">{{$banner->title}}</span>
                                    <h1 class="hero-title">{{$banner->title}}</h1>
                                    <p class="hero-description">{!! html_entity_decode($banner->description) !!}</p>
                                    <a class="btn btn-primary" href="#" role="button">VIEW MORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            @endforeach
    </section>


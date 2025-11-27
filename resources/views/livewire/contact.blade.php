<div id="bwp-main" class="bwp-main">
    <!-- Page Title -->
    <div class="page-title bwp-title" style="background-image:url(https://covan.wpbingosite.com/wp-content/uploads/2020/08/add-pagetitle.jpg);">
        <div class="container">
            <h1>Contact</h1>
            <div id="breadcrumb" class="breadcrumb">
                <div class="bwp-breadcrumb">
                    <a href="{{route('home')}}">Home</a> 
                    <span class="delimiter"></span> 
                    <span class="current">Contact</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Google Maps -->
    <section class="map-section">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="map-container">
                        <iframe loading="lazy" src="https://maps.google.com/maps?q=London%20Eye%2C%20London%2C%20United%20Kingdom&amp;t=m&amp;z=10&amp;output=embed&amp;iwloc=near" title="London Eye, London, United Kingdom" aria-label="London Eye, London, United Kingdom" style="width:100%;height:400px;border:0;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="contact-form-section">
        <div class="container">
            <div class="row">
                <!-- Form Column -->
                <div class="col-lg-6 col-md-12">
                    <div class="contact-us-form">
                        <div class="title">
                            <p>Get In Touch</p>
                        </div>
                        
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form class="form" method="post" wire:submit.prevent="submit">
                            <div class="row">
                                <div class="col-sm-12 col-md-4 form-required">
                                    <p>
                                        <input type="text" placeholder="Name*" required wire:model.defer="name" class="form-control">
                                        @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </p>
                                </div>
                                <div class="col-sm-12 col-md-4 form-required">
                                    <p>
                                        <input type="text" placeholder="Address*" required wire:model.defer="address" class="form-control">
                                        @error('address')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </p>
                                </div>
                                <div class="col-sm-12 col-md-4 form-required">
                                    <p>
                                        <input type="email" placeholder="Email*" required wire:model.defer="email" class="form-control">
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 ">
                                    <p>
                                        <textarea cols="70" rows="10" placeholder="Message" required wire:model.defer="message" class="form-control"></textarea>
                                        @error('message')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </p>
                                </div>
                            </div>
                            <div class="button">
                                <p>
                                    <input type="submit" value="send message" class="btn-submit">
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Contact Info Column -->
                <div class="col-lg-6 col-md-12">
                    <div class="contact-info-wrapper">
                        <h2>address</h2>
                        <p>14 LE Gounlburn St, Sydney 1198NSA.</p>
                        
                        <h2>Phone</h2>
                        <p>(+089) 19918989 – 0123456789</p>
                        
                        <h2>Email</h2>
                        <p>support@domain.com – demo@demo.com</p>
                        
                        <h2>Follow Us</h2>
                        <ul class="social-link">
                            <li><a href="#"><i class="icon-x-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



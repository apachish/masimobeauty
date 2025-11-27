<div id="bwp-main" class="bwp-main">
    <!-- Page Title -->
    <div class="page-title bwp-title" style="background-image:url(https://covan.wpbingosite.com/wp-content/uploads/2020/08/add-pagetitle.jpg);">
        <div class="container">
            <h1>Order Track</h1>

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div id="main-content" class="main-content">
                    <div id="primary" class="content-area">
                        <div id="content" class="site-content" role="main">
                            <article class="post page hentry">
                                <div class="entry-content clearfix">
                                    <!-- First Section: Image and Text -->
                                    <section class="about-section about-intro">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <p class="about-text">
                                                        To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.                                                        </p>

                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 m-t-50">
                                                    <div class="about-content">
                                                        <div class="about-signature">
                                                            <form class="form" method="post" wire:submit.prevent="track_order">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <input type="text" placeholder="Enter your order number"  class="form-control" required="required" wire:model="order_number">
                                                                            @error('order_number')
                                                                            <span class="text-danger">{{$message}}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group login-btn">
                                                                            <button class="btn btn-login" type="submit">Track Order</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

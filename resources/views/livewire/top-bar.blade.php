<div>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            @if($showContactInfo)
                <div class="top-bar-left">
                    <span class="contact-info"><i class="fas fa-phone"></i> +84 100-2345-6799</span>
                    <span class="separator"></span>
                    <span class="contact-info"><i class="fas fa-envelope"></i> contact@masimobeauty.com</span>
                </div>
            @else
                <p class="sale-text">Winter-Season Sale Up To 25% OFF Products</p>
            @endif
            <div class="top-icons">
                <i class="ti-location-pin"></i> <a href="{{route('product.track')}}">Track Order</a>
                <span class="separator"></span>
            @if(!$showContactInfo)
                    <a href="{{ route('wishlist') }}"><i class="far fa-heart"></i> Wishlist</a>
                    <span class="separator"></span>
                @endif
                    @auth
                        <div class="account-dropdown-wrapper" wire:click.away="showAccountDropdown = false">
                            <a href="#" wire:click.prevent="toggleAccountDropdown"><i class="far fa-user"></i> My Account</a>
                            @if($showAccountDropdown)
                                <div class="account-dropdown" wire:click.stop>
                                    <a href="#" wire:click="showAccountDropdown = false"><i class="far fa-user"></i> My Account</a>
                                    <a href="#" wire:click="showAccountDropdown = false"><i class="fas fa-shopping-cart"></i> Checkout</a>
                                    <a href="{{ route('wishlist') }}" wire:click="showAccountDropdown = false"><i class="far fa-heart"></i> Wishlist</a>
                                </div>
                            @endif
                        </div>
                    @else
                        <i class="ti-power-off"></i><a href="{{route('login.user')}}">Login /</a> <a href="{{route('register.user')}}">Register</a>
                    @endauth

                <span class="separator"></span>
                <a href="#"><i class="fab fa-x-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
</div>

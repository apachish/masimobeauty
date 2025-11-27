<div>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <!-- Mobile Menu Button -->
            <button class="mobile-menu-btn" wire:click="toggleMobileMenu" x-data @click="showMobileMenu = !showMobileMenu">
                <i class="fas fa-bars"></i>
            </button>

            <div class="logo">
                <span class="logo-text">masim<span class="logo-circle">o</span>beauty</span>
            </div>

            <nav class="nav">
                <a href="{{ route('home') }}" class="active">HOME </a>
                <div class="nav-dropdown-wrapper" x-data="{ open: false }" @click.away="open = false">
                    <a href="#" @click.prevent="open = !open">SHOP <i class="fas fa-chevron-down"></i></a>
                    <div class="mega-menu shop-menu" x-show="open" x-transition style="display: none;" x-cloak>
                            <div class="mega-menu-column">
                                <h4>SHOP LAYOUT</h4>
                                <ul>
                                    <li><a href="#">Sidebar</a></li>
                                    <li><a href="#">Filter Drawer</a></li>
                                    <li><a href="#">Filter Dropdown</a></li>
                                    <li><a href="#">Filter Off Canvas</a></li>
                                    <li><a href="#">Shop Image Categories</a></li>
                                    <li><a href="#">Shop Mini Categories</a></li>
                                    <li><a href="#">Shop Only Categories</a></li>
                                    <li><a href="#">Shop Icon Categories</a></li>
                                    <li><a href="#">Shop Categories Banner</a></li>
                                    <li><a href="#">Shop Bestseller Section</a></li>
                                </ul>
                            </div>
                            <div class="mega-menu-column">
                                <h4>PRODUCT LAYOUT</h4>
                                <ul>
                                    <li><a href="#">Layout Zoom</a></li>
                                    <li><a href="#">Layout Scroll</a></li>
                                    <li><a href="#">Layout Sticky</a></li>
                                    <li><a href="#">Layout Sticky 2</a></li>
                                    <li><a href="#">Slider</a></li>
                                    <li><a href="#">Large Grid</a></li>
                                    <li><a href="#">Small Grid</a></li>
                                    <li><a href="#">Video</a></li>
                                </ul>
                            </div>
                            <div class="mega-menu-column">
                                <h4>PRODUCT IMAGE</h4>
                                <ul>
                                    <li><a href="#">Left Thumbnail</a></li>
                                    <li><a href="#">Right Thumbnail</a></li>
                                    <li><a href="#">Bottom Thumbnail</a></li>
                                    <li><a href="#">Outside Thumbnail</a></li>
                                </ul>
                                <h4 class="sub-heading">PRODUCTS TYPE</h4>
                                <ul>
                                    <li><a href="#">Simple Product</a></li>
                                    <li><a href="#">Group Product</a></li>
                                    <li><a href="#">Variable Product</a></li>
                                    <li><a href="#">External & Affiliate Product</a></li>
                                </ul>
                            </div>
                            <div class="mega-menu-column">
                                <h4>PRODUCT EXTENDED</h4>
                                <ul>
                                    <li><a href="#">Product Countdown</a></li>
                                    <li><a href="#">Product Boost Sale</a></li>
                                    <li><a href="#">Trust Badges</a></li>
                                    <li><a href="#">Gift Boxed</a></li>
                                    <li><a href="#">Featured Icon</a></li>
                                    <li><a href="#">Extra Sidebar</a></li>
                                    <li><a href="#">Sticky Add To Cart</a></li>
                                </ul>
                            </div>
                        </div>
                </div>
                <div class="nav-dropdown-wrapper" x-data="{ open: false }" @click.away="open = false">
                    <a href="#" @click.prevent="open = !open">BLOG <i class="fas fa-chevron-down"></i></a>
                    <div class="mega-menu blog-menu" x-show="open" x-transition style="display: none;" x-cloak>
                            <div class="mega-menu-column">
                                <h4>POST LAYOUT</h4>
                                <ul>
                                    <li><a href="#">Left Sidebar</a></li>
                                    <li><a href="#">Right Sidebar</a></li>
                                    <li><a href="#">Without Sidebar</a></li>
                                </ul>
                            </div>
                            <div class="mega-menu-column">
                                <h4>BLOG LAYOUT</h4>
                                <ul>
                                    <li><a href="#">Blog Left Sidebar</a></li>
                                    <li><a href="#">Blog Right Sidebar</a></li>
                                    <li><a href="#">Blog Without Sidebar</a></li>
                                </ul>
                            </div>
                            <div class="mega-menu-column">
                                <h4>BLOG STYLE</h4>
                                <ul>
                                    <li><a href="#">Blog List</a></li>
                                    <li><a href="#">Blog Grid</a></li>
                                </ul>
                            </div>
                            <div class="mega-menu-column">
                                <h4>POST FORMAT</h4>
                                <ul>
                                    <li><a href="#">Post format gallery</a></li>
                                    <li><a href="#">Post format video</a></li>
                                    <li><a href="#">Post format audio</a></li>
                                    <li><a href="#">Post format quote</a></li>
                                </ul>
                            </div>
                        </div>
                </div>
                <a href="{{route("about")}}">About </a>
                <a href="{{route("contact")}}">Contact</a>
            </nav>
            <div class="header-icons">
                <a href="#"><i class="fas fa-search"></i></a>
                <a href="{{ route('wishlist') }}" class="wishlist-icon"><i class="far fa-heart"></i> <span class="wishlist-badge">0</span></a>
                <a href="{{ route('cart') }}" class="cart-icon"><i class="fas fa-shopping-bag"></i> <span class="cart-badge">0</span></a>
                <span class="cart-total-mobile">$0.00</span>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu" x-data="{ open: @entangle('showMobileMenu') }" x-show="open" x-transition x-cloak style="display: none;">
            <div class="mobile-menu-content">
                <a href="{{ route('home') }}" wire:click="showMobileMenu = false">HOME</a>
                <a href="#" wire:click="showMobileMenu = false">SHOP</a>
                <a href="#" wire:click="showMobileMenu = false">BLOG</a>
                <a href="#" wire:click="showMobileMenu = false">PAGE</a>
                <a href="#" wire:click="showMobileMenu = false">VENDORS</a>
            </div>
        </div>
    </header>

    <!-- Bottom Navigation (Mobile Only) -->
    <nav class="bottom-nav">
        <a href="{{ route('home') }}" class="bottom-nav-item">
            <i class="fas fa-store"></i>
            <span>Shop</span>
        </a>
        <a href="#" class="bottom-nav-item">
            <i class="far fa-user"></i>
            <span>Account</span>
        </a>
        <a href="#" class="bottom-nav-item">
            <i class="fas fa-search"></i>
            <span>Search</span>
        </a>
        <a href="{{ route('wishlist') }}" class="bottom-nav-item">
            <i class="far fa-heart"></i>
            <span>Wishlist</span>
        </a>
    </nav>
</div>

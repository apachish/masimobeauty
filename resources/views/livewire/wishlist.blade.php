<div>
    <section class="wishlist-section">
        <div class="container">
            <h1 class="page-title">Wishlist</h1>
            
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            
            @if(count($wishlistItems) > 0)
                <div class="wishlist-table-wrapper">
                    <table class="wishlist-table">
                        <thead>
                            <tr>
                                <th>PRODUCT NAME</th>
                                <th>UNIT PRICE</th>
                                <th>STOCK STATUS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wishlistItems as $item)
                                <tr>
                                    <td class="product-info">
                                        <div class="product-image">
                                            <img src="{{ $item['image'] ?? asset('images/placeholder.jpg') }}" alt="{{ $item['name'] }}">
                                        </div>
                                        <div class="product-details">
                                            <h3>{{ $item['name'] }}</h3>
                                        </div>
                                    </td>
                                    <td class="unit-price">${{ number_format($item['price'], 2) }}</td>
                                    <td class="stock-status">
                                        <span class="status-badge {{ $item['in_stock'] ? 'in-stock' : 'out-of-stock' }}">
                                            {{ $item['in_stock'] ? 'In Stock' : 'Out of Stock' }}
                                        </span>
                                    </td>
                                    <td class="actions">
                                        <button wire:click="removeFromWishlist({{ $item['id'] }})" class="btn-remove" title="Remove from wishlist">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button wire:click="addToCart({{ $item['id'] }})" class="btn-add-cart" title="Add to cart">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-wishlist">
                    <div class="empty-icon">
                        <i class="far fa-heart"></i>
                    </div>
                    <h2>No products added to the wishlist</h2>
                    <p>You haven't added any products to your wishlist yet.</p>
                    <a href="{{ route('home') }}" class="btn-primary">Continue Shopping</a>
                </div>
            @endif
        </div>
    </section>
</div>

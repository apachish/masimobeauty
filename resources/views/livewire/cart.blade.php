<div>
    <section class="cart-section">
        <div class="container">
            <h1 class="page-title">Cart</h1>
            
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if(count($cartItems) > 0)
                <div class="cart-table-wrapper">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>PRODUCT</th>
                                <th>PRICE</th>
                                <th>QUANTITY</th>
                                <th>SUBTOTAL</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
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
                                    <td class="quantity">
                                        <div class="quantity-controls">
                                            <button wire:click="decreaseQuantity({{ $item['id'] }})" class="qty-btn">-</button>
                                            <input type="number" value="{{ $item['quantity'] }}" min="1" readonly>
                                            <button wire:click="increaseQuantity({{ $item['id'] }})" class="qty-btn">+</button>
                                        </div>
                                    </td>
                                    <td class="subtotal">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    <td class="actions">
                                        <button wire:click="removeFromCart({{ $item['id'] }})" class="btn-remove" title="Remove from cart">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                <td class="total-price"><strong>${{ number_format($total, 2) }}</strong></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    
                    <div class="cart-actions">
                        <a href="{{ route('home') }}" class="btn-continue-shopping">
                            <i class="fas fa-arrow-left"></i> Continue Shopping
                        </a>
                        <a href="#" class="btn-checkout">Proceed to Checkout</a>
                    </div>
                </div>
            @else
                <div class="empty-cart">
                    <div class="empty-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h2>Your cart is currently empty.</h2>
                    <a href="{{ route('home') }}" class="btn-return-shop">
                        <i class="fas fa-arrow-left"></i> RETURN TO SHOP
                    </a>
                </div>
            @endif
        </div>
    </section>
</div>

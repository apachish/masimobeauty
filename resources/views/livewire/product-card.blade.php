<div class="product-card" wire:key="product-{{ data_get($product,'id') }}">
    @if(data_get($product,'discount'))
    <div class="discount-badge">-{{data_get($product,'discount')}}%</div>
    @endif
    <div class="product-img product-img-1">
        <img src="{{data_get($product,'photo')}}" alt="{{data_get($product,'title')}}">
        <div class="product-actions">
            <button type="button" class="product-action-btn" title="Add to Cart">
                <i class="fas fa-shopping-bag"></i>
            </button>
            <button type="button" class="product-action-btn" title="Add to Wishlist">
                <i class="fas fa-heart"></i>
            </button>
            <button type="button" class="product-action-btn" title="Quick View">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <div class="rating">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star-half-alt"></i>
        <span class="review-count">1</span>
    </div>
    <h4>{{data_get($product,'title')}}</h4>
    <div class="price">
        @if(data_get($product,'discount'))
            <span class="old-price">${{number_format(data_get($product,'price'), 2)}}</span>
            <span class="current-price">${{number_format(data_get($product,'price')*((100-data_get($product,'discount'))/100), 2)}}</span>
        @else
            ${{number_format(data_get($product,'price'), 2)}}
        @endif
    </div>
</div>


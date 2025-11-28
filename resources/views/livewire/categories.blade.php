<div>
    <!-- Product Categories -->
    <section class="categories">
        <div class="container">
            <div class="category-grid">
                @foreach($categories as $category)
                <div class="category-card">
                    <div class="category-image">
                        <img src="{{data_get($category,'photo')}}" alt="{{data_get($category,'title')}}">
                        <h3 class="category-title">{{data_get($category,'title')}}</h3>
                        <a href="/product-cat/{{data_get($category,'slug')}}" class="category-btn">VIEW CATEGORY</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

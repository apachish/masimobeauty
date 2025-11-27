<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Home::class)->name('home');

Route::get('/contact', \App\Livewire\Contact::class)->name('contact');
Route::get('/about', \App\Livewire\Pages\AboutUs::class)->name('about');
Route::get('/product/track', \App\Livewire\Pages\ProductTrack::class)->name('product.track');

Route::get('dashboard', \App\Livewire\Admin\Index::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
Route::get('/wishlist', [\App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist');
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart');


// CACHE CLEAR ROUTE
Route::get('cache-clear', function () {
    Artisan::call('optimize:clear');
    request()->session()->flash('success', 'Successfully cache cleared.');
    return redirect()->back();
})->name('cache.clear');


// STORAGE LINKED ROUTE
Route::get('storage-link',[\App\Http\Controllers\AdminController::class,'storageLink'])->name('storage.link');


//Route::get('/', [FrontendController::class, 'home'])->name('home');
//
//// Frontend Routes
//Route::get('/home', [FrontendController::class, 'index']);
//Route::get('/about-us', [FrontendController::class, 'aboutUs'])->name('about-us');
//Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
//Route::post('/contact/message', [MessageController::class, 'store'])->name('contact.store');
//Route::get('product-detail/{slug}', [FrontendController::class, 'productDetail'])->name('product-detail');
//Route::post('/product/search', [FrontendController::class, 'productSearch'])->name('product.search');
//Route::get('/product-cat/{slug}', [FrontendController::class, 'productCat'])->name('product-cat');
//Route::get('/product-sub-cat/{slug}/{sub_slug}', [FrontendController::class, 'productSubCat'])->name('product-sub-cat');
//Route::get('/product-brand/{slug}', [FrontendController::class, 'productBrand'])->name('product-brand');
//// Cart section
//Route::get('/add-to-cart/{slug}', [CartController::class, 'addToCart'])->name('add-to-cart')->middleware('user');
//Route::post('/add-to-cart', [CartController::class, 'singleAddToCart'])->name('single-add-to-cart')->middleware('user');
//Route::get('cart-delete/{id}', [CartController::class, 'cartDelete'])->name('cart-delete');
//Route::post('cart-update', [CartController::class, 'cartUpdate'])->name('cart.update');
//
//Route::get('/cart', function () {
//    return view('frontend.pages.cart');
//})->name('cart');
//Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('user');
//// Wishlist
//Route::get('/wishlist', function () {
//    return view('frontend.pages.wishlist');
//})->name('wishlist');
//Route::get('/wishlist/{slug}', [WishlistController::class, 'wishlist'])->name('add-to-wishlist')->middleware('user');
//Route::get('wishlist-delete/{id}', [WishlistController::class, 'wishlistDelete'])->name('wishlist-delete');
//Route::post('cart/order', [OrderController::class, 'store'])->name('cart.order');
//Route::get('order/pdf/{id}', [OrderController::class, 'pdf'])->name('order.pdf');
Route::get('/income', [OrderController::class, 'incomeChart'])->name('product.order.income');
//// Route::get('/user/chart',[AdminController::class, 'userPieChart'])->name('user.piechart');
//Route::get('/product-grids', [FrontendController::class, 'productGrids'])->name('product-grids');
//Route::get('/product-lists', [FrontendController::class, 'productLists'])->name('product-lists');
//Route::match(['get', 'post'], '/filter', [FrontendController::class, 'productFilter'])->name('shop.filter');
//// Order Track
//Route::get('/product/track', [OrderController::class, 'orderTrack'])->name('order.track');
//Route::post('product/track/order', [OrderController::class, 'productTrackOrder'])->name('product.track.order');
//// Blog
//Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
//Route::get('/blog-detail/{slug}', [FrontendController::class, 'blogDetail'])->name('blog.detail');
//Route::get('/blog/search', [FrontendController::class, 'blogSearch'])->name('blog.search');
//Route::post('/blog/filter', [FrontendController::class, 'blogFilter'])->name('blog.filter');
//Route::get('blog-cat/{slug}', [FrontendController::class, 'blogByCategory'])->name('blog.category');
//Route::get('blog-tag/{slug}', [FrontendController::class, 'blogByTag'])->name('blog.tag');
//
//// NewsLetter
//Route::post('/subscribe', [FrontendController::class, 'subscribe'])->name('subscribe');
//

//// Coupon
//Route::post('/coupon-store', [CouponController::class, 'couponStore'])->name('coupon-store');
//// Payment
//Route::get('payment', [PayPalController::class, 'payment'])->name('payment');
//Route::get('cancel', [PayPalController::class, 'cancel'])->name('payment.cancel');
//Route::get('payment/success', [PayPalController::class, 'success'])->name('payment.success');
//
//
// Backend section start

Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', \App\Livewire\Admin\Index::class)->name('admin');
    Route::get('/file-manager', function () {
        return view('livewire.admin.layouts.file-manager');
    })->name('file-manager');
    // user route
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', \App\Livewire\Admin\Users\Index::class)->name('index');
        Route::get('/create', \App\Livewire\Admin\Users\Create::class)->name('create');
        Route::get('/{user}/edit', \App\Livewire\Admin\Users\Edit::class)->name('edit');
    });
    // Banner
    Route::prefix('banner')->name('banner.')->group(function () {
        Route::get('/', \App\Livewire\Admin\Banner\Index::class)->name('index');
        Route::get('/create', \App\Livewire\Admin\Banner\Create::class)->name('create');
        Route::get('/{banner}/edit', \App\Livewire\Admin\Banner\Edit::class)->name('edit');
    });
    // Brand
    Route::prefix('brand')->name('brand.')->group(function () {
        Route::get('/', \App\Livewire\Admin\Brand\Index::class)->name('index');
        Route::get('/create', \App\Livewire\Admin\Brand\Create::class)->name('create');
        Route::get('/{brand}/edit', \App\Livewire\Admin\Brand\Edit::class)->name('edit');
    });
    // Category
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', \App\Livewire\Admin\Category\Index::class)->name('index');
        Route::get('/create', \App\Livewire\Admin\Category\Create::class)->name('create');
        Route::get('/{category}/edit', \App\Livewire\Admin\Category\Edit::class)->name('edit');
    });
    // Product
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', \App\Livewire\Admin\Product\Index::class)->name('index');
        Route::get('/create', \App\Livewire\Admin\Product\Create::class)->name('create');
        Route::get('/{product}/edit', \App\Livewire\Admin\Product\Edit::class)->name('edit');
    });
    // Profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin-profile');
    Route::post('/profile/{id}', [AdminController::class, 'profileUpdate'])->name('profile-update');


    // Ajax for sub category
    Route::post('/category/{id}/child', 'CategoryController@getChildByParent');
    // POST category
    Route::prefix('post-category')->name('post-category.')->group(function () {
        Route::get('/', \App\Livewire\Admin\PostCategory\Index::class)->name('index');
        Route::get('/create', \App\Livewire\Admin\PostCategory\Create::class)->name('create');
        Route::get('/{category}/edit', \App\Livewire\Admin\PostCategory\Edit::class)->name('edit');
    });
    // Post tag
    Route::prefix('post-tag')->name('post-tag.')->group(function () {
        Route::get('/', \App\Livewire\Admin\Posttag\Index::class)->name('index');
        Route::get('/create', \App\Livewire\Admin\Posttag\Create::class)->name('create');
        Route::get('/{tag}/edit', \App\Livewire\Admin\Posttag\Edit::class)->name('edit');
    });
    // Post
    Route::prefix('post')->name('post.')->group(function () {
        Route::get('/',  \App\Livewire\Admin\Post\Index::class)->name('index');
        Route::get('/create',  \App\Livewire\Admin\Post\Create::class)->name('create');
        Route::get('/{post}/edit',  \App\Livewire\Admin\Post\Edit::class)->name('edit');
    });
    // Message
    Route::resource('/message', 'MessageController');
    Route::get('/message/five', [MessageController::class, 'messageFive'])->name('messages.five');

    // Order
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/', \App\Livewire\Admin\Order\Index::class)->name('index');
        Route::get('/create', \App\Livewire\Admin\Order\Pdf::class)->name('pdf');
        Route::get('/{order}/show', \App\Livewire\Admin\Order\Show::class)->name('show');
        Route::get('/{order}/edit', \App\Livewire\Admin\Order\Edit::class)->name('edit');
    });
    // Shipping
    Route::prefix('shipping')->name('shipping.')->group(function () {
        Route::get('/', \App\Livewire\Admin\Shipping\Index::class)->name('index');
        Route::get('/create', \App\Livewire\Admin\Shipping\Create::class)->name('create');
        Route::get('/{shipping}/edit', \App\Livewire\Admin\Shipping\Edit::class)->name('edit');
    });
    // Coupon
    Route::prefix('coupon')->name('coupon.')->group(function () {
        Route::get('/', \App\Livewire\Admin\Coupon\Index::class)->name('index');
        Route::get('/create', \App\Livewire\Admin\Coupon\Create::class)->name('create');
        Route::get('/{coupon}/edit', \App\Livewire\Admin\Coupon\Edit::class)->name('edit');
    });


    // Coupon
    Route::prefix('review')->name('review.')->group(function () {
        Route::get('/', \App\Livewire\Admin\Review\Index::class)->name('index');
//        Route::get('/product/{slug}/review', \App\Livewire\Admin\Review\Create::class)->name('review.store');
    });
    // Coupon
    Route::prefix('comment')->name('comment.')->group(function () {
        Route::get('/', \App\Livewire\Admin\Comment\Index::class)->name('index');
//        Route::get('/post/{slug}/comment', \App\Livewire\Admin\Comment\Create::class)->name('post-comment.store');
    });
    // Settings
    Route::get('settings', \App\Livewire\Admin\Setting::class)->name('settings');

    // Notification
    Route::get('/notification/{id}', [NotificationController::class, 'show'])->name('admin.notification');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('all.notification');
    Route::delete('/notification/{id}', [NotificationController::class, 'delete'])->name('notification.delete');
    // Password Change
    Route::get('change-password', [AdminController::class, 'changePassword'])->name('change.password.form');
    Route::post('change-password', [AdminController::class, 'changPasswordStore'])->name('change.password');
});


// User section start
Route::group(['prefix' => '/user', 'middleware' => ['user']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('user');
    // Profile
    Route::get('/profile', [HomeController::class, 'profile'])->name('user-profile');
    Route::post('/profile/{id}', [HomeController::class, 'profileUpdate'])->name('user-profile-update');
    //  Order
    Route::get('/order', "HomeController@orderIndex")->name('user.order.index');
    Route::get('/order/show/{id}', "HomeController@orderShow")->name('user.order.show');
    Route::delete('/order/delete/{id}', [HomeController::class, 'userOrderDelete'])->name('user.order.delete');
    // Product Review
    Route::get('/user-review', [HomeController::class, 'productReviewIndex'])->name('user.productreview.index');
    Route::delete('/user-review/delete/{id}', [HomeController::class, 'productReviewDelete'])->name('user.productreview.delete');
    Route::get('/user-review/edit/{id}', [HomeController::class, 'productReviewEdit'])->name('user.productreview.edit');
    Route::patch('/user-review/update/{id}', [HomeController::class, 'productReviewUpdate'])->name('user.productreview.update');

    // Post comment
    Route::get('user-post/comment', [HomeController::class, 'userComment'])->name('user.post-comment.index');
    Route::delete('user-post/comment/delete/{id}', [HomeController::class, 'userCommentDelete'])->name('user.post-comment.delete');
    Route::get('user-post/comment/edit/{id}', [HomeController::class, 'userCommentEdit'])->name('user.post-comment.edit');
    Route::patch('user-post/comment/udpate/{id}', [HomeController::class, 'userCommentUpdate'])->name('user.post-comment.update');

    // Password Change
    Route::get('change-password', [HomeController::class, 'changePassword'])->name('user.change.password.form');
    Route::post('change-password', [HomeController::class, 'changPasswordStore'])->name('change.password');

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

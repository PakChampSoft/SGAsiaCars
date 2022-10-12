<?php

use App\Http\Controllers\Admin\AccessoryController;
use App\Http\Controllers\Admin\APIController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AutoPartController;
use App\Http\Controllers\Admin\CloneController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\DealController;
use App\Http\Controllers\Admin\ExcelController;
use App\Http\Controllers\Admin\GallaryController;
use App\Http\Controllers\Admin\MetaController;
// use App\Http\Controllers\Admin\ModelController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PortController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Customer\NotificationController;
use App\Http\Controllers\Customer\QuoteController as CustomerQuoteController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PreOrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserActivityController;
use App\Http\Controllers\VigoasiaApiController;
use App\Http\Controllers\PageMetaController;
use App\Http\Controllers\RoutCacheContrller;
use App\Models\Blog;
use App\Models\PageMeta;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Facades\Hash;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('thanks', [RoutCacheContrller::class, 'thanks']);
Route::get('hash/password', function(){
    $pass= "I9~SoN[jMeqT";
    $password = Hash::make($pass);
    return $password;
});
// Cache Routes
Route::get('/cache/routes', [RoutCacheContrller::class, 'index'])->name("cache.clear");
// Route::get('/cache/routes', function(){
//     dd(2);
// });
// home route
Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');

// prodcut/vehicle detail route
Route::get('/{company}-{type}-{transmission}-{engine}-{ref}', [LandingPageController::class, 'productDetail'])->name('landing.detail');
Route::get('detail/{company}/{url}', [LandingPageController::class, 'shownew'])->name('seodetail');
// download images in zip
Route::get('/{id}/zip', [ProductController::class, 'zipImages'])->name('products.zip');

// stocklist route
Route::get('/stocklist', [LandingPageController::class, 'stockList'])->name('landing.stocklist');

// full text search route
Route::get('/search', [LandingPageController::class, 'fullTextSearch'])->name('landing.full_text');

// vehicle details page route
// Route::get('/detail', function(){
//     return view('detail');
// });

// Quote request
Route::post('quote-request', [QuoteController::class, 'store'])->name('landing.quote-request');
// Resent To Thank You Page
Route::get('product/{id}/submitted', [QuoteController::class, 'after_query_submit'])->name('after_query_submit');

// stocklist page route
// Route::get('/stocklist', function(){
//     return view('stocklist');
// });

// contact us page route
// Route::get('/toyota-4wd-hilux', function(){
//     $pageTitle = 'Contact Us';
//     $pagedata = PageMeta::where('page_url', 'about-us')->first();
//     ret
// });

// CONTACT US PAGE ROUTE
Route::get('/toyota-4wd-hilux', [LandingPageController::class, 'contactUsForm']);

Route::post('/toyota-4wd-hilux', [LandingPageController::class, 'contactUs'])->name('landing.contact');
// Thanks Redirection after Contact Us
Route::get('toyota-4we-hilux/submitted', [LandingPageController::class, 'contact_redirect_thanks'])->name('contact_redirect_thanks');

// about us page route
Route::get('/about-us', function(){
    $pageTitle = 'About Us';
    $pagedata = PageMeta::where('page_url', 'about-us')->first();
    // dd($pagedata);
    return view('new_website.about-us', compact('pageTitle', 'pagedata'));
});

// privacy policy page route
Route::get('/privacy-policy', function(){
    $pageTitle = 'Privacy Policy';
    $pagedata = PageMeta::where('page_url', 'privacy-policy')->first();
    return view('new_website.privacy-policy', compact('pageTitle', 'pagedata'));
});

// terms and conditions page route
Route::get('/terms-conditions', function(){
    $pageTitle = 'Terms & Conditions';
    $pagedata = PageMeta::where('page_url', 'terms-conditions')->first();
    return view('new_website.terms-conditions', compact('pageTitle', 'pagedata'));
});

// disclaimer page route
Route::get('/disclaimer', function(){
    $pageTitle = 'Disclaimer Policy';
    $pagedata = PageMeta::where('page_url', 'disclaimer')->first();
    return view('new_website.disclaimer', compact('pageTitle','pagedata'));
});

// how to buy page route
Route::get('/how-to-buy', function(){
    $pageTitle = 'How to buy';
    $pagedata = PageMeta::where('page_url', 'how-to-buy')->first();

    return view('new_website.how-to-buy', compact('pageTitle', 'pagedata'));
});

// blogs routes
Route::get('/blog', [LandingPageController::class, 'blogs'])->name('landing.blogs');
Route::get('/blog/{slug}', [LandingPageController::class, 'showBlog'])->name('landing.blog');

// pre order
Route::get('/pre-order/{product_id}', [PreOrderController::class, 'create'])->name('pre-order')->middleware('auth');
Route::post('/pre-order', [PreOrderController::class, 'store'])->name('pre-order.store')->middleware('auth');

// auth routes
Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/sg-backend/login', [AuthController::class, 'showLoginForm']);
Route::post('/sg-backend/login', [AuthController::class, 'processLogin']);


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        // CLEANING MILLAGE DATABASE
        // Route::get('clean/mileage', [RoutCacheContrller::class, 'clean_mileage']);
        //  SEO MANAGEMENT
        Route::get('seo', [PageMetaController::class, 'index'])->name('seo.index');
        Route::get('seo/create', [PageMetaController::class, 'create'])->name('seo.create');
        Route::post('seo/store', [PageMetaController::class, 'store'])->name('seo.store');
        Route::get('seo/{id}/edit', [PageMetaController::class, 'edit'])->name('seo.edit');
        Route::put('seo/{id}/update', [PageMetaController::class, 'update'])->name('seo.update');
        Route::get('seo/{id}/delete', [PageMetaController::class, 'destroy'])->name('seo.destroy');
        // Route::resource('seo', PageMetaController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        // user extra routes
        Route::get('vendors', [UserController::class, 'vendorsIndex'])->name('users.vendors');
        Route::get('customers', [UserController::class, 'customersIndex'])->name('users.customers');

        Route::resource('clones', CloneController::class);
        Route::resource('countries', CountryController::class);
        Route::resource('ports', PortController::class);

        // products management routes
        Route::resource('products', ProductController::class);
        Route::get('/gallary/{product_id}/show', [GallaryController::class, 'show'])->name('gallery.show');
        Route::get('/gallary/bulk/update', [GallaryController::class, 'bulkUpdate'])->name('gallery.bulkupdate');
        Route::get('/gallary/{id}/delete', [GallaryController::class, 'destroy'])->name('gallary.destroy');
        Route::get('/gallary/{id}/deleteAll', [GallaryController::class, 'destroyAll'])->name('gallary.destroyAll');
        Route::put('/products/status/{id}', [ProductController::class, 'updateStatus'])->name('products.status.update');

        // bulk available, unavailable, sold, hold
        Route::get('/products/bulk/available', [ProductController::class, 'bulkAvailable']);
        Route::get('/products/bulk/unavailable', [ProductController::class, 'bulkUnavailable']);
        Route::get('/products/bulk/sold', [ProductController::class, 'bulkSold']);
        Route::get('/products/bulk/onhold', [ProductController::class, 'bulkOnhold']);

        Route::resource('deals', DealController::class);
        Route::resource('parts', AutoPartController::class);

        // vehicle attributes routes
        Route::resource('companies', CompanyController::class);
        // Route::resource('models', ModelController::class);
        Route::resource('types', TypeController::class);
        Route::resource('colors', ColorController::class);
        Route::resource('accessories', AccessoryController::class);
        Route::resource('currencies', CurrencyController::class);

        // content management roues
        Route::resource('contents', ContentController::class);

        // shipping routes
        Route::resource('shippings', ShippingController::class);

        // quotes route
        Route::resource('quotes', QuoteController::class);

        // outsource api client routes
        Route::resource('api-clients', APIController::class);
        Route::get('api-clients/{id}/status', [APIController::class, 'toggleStatus'])->name('api-clients.status');

        // excel management
        Route::get('excel', [ExcelController::class, 'index'])->name('excel.index');

        // user activities logs
        Route::resource('user-activities', UserActivityController::class);
        Route::get('user-activities/download/{id}', [UserActivityController::class, 'downloadReport'])->name('user-activities.report');

        // blogs routes
        Route::resource('blogs', BlogController::class);

        // meta controller routes
        Route::resource('metas', MetaController::class);

    });
});

Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');


// Api Route Start
    Route::get('Api/VigoasiaApi', [VigoasiaApiController::class, 'index'])->name('VigoasiaApi');
// Api Route Start


// sitemap
Route::get('/gen-sm', function(){
    $path = public_path('sitemap.xml');
    // dd($path);
    $products = Product::all();
    $blogs = Blog::all();
    // set_time_limit(3600);
    Sitemap::create()
        ->add(config('app.url'))
        ->add(Url::create('/about-us'))
        ->add(Url::create('/toyota-4wd-hilux'))
        ->add(Url::create('/how-to-buy'))
        ->add(Url::create('https://vigoasia1.click2stream.com/'))
        ->add($products)
        ->add(Url::create('/privacy-policy'))
        ->add(Url::create('/terms-condition'))
        ->add(Url::create('/disclaimer'))
        ->add(Url::create('/blog'))
        ->add($blogs)
        ->add(Url::create('/sitemap.xml'))
        ->writeToFile($path);
    // SitemapGenerator::create('https://sgasiacars.com')->writeToFile($path);
    return 'generated';
});



// customer / user dashboard routes
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::prefix('user')->group(function () {

        // my quotes
        Route::get('/quotes', [CustomerQuoteController::class, 'myQuotes'])->name('user.quote.index');

        // my notifications
        Route::get('/notifications', [NotificationController::class, 'myNotifications'])->name('user.notification.index');

        // notify me
        Route::get('/notify-me/{product}', [NotificationController::class, 'notifyMe'])->name('user.notification.store');

    });
});


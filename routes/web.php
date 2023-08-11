<?php

declare(strict_types=1);

use App\Http\Controllers\ErrorController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\CheckoutController;
use App\Http\Livewire\Front\Index as FrontIndex;
use App\Http\Livewire\Front\Categories as CategoryIndex;
use App\Http\Livewire\Front\Catalog as CatalogIndex;
use App\Http\Livewire\Front\Races as RaceIndex;
use App\Http\Livewire\Front\Checkout as CheckoutIndex;
use App\Http\Livewire\Front\CheckoutRace;
use App\Http\Livewire\Front\Blogs as BlogIndex;
use App\Http\Livewire\Account\Index as AccountIndex;
use App\Http\Livewire\Front\BlogShow;
use App\Http\Livewire\Front\DynamicPage;
use App\Http\Livewire\Front\RaceDetails;
use App\Http\Controllers\UploadController;
use App\Http\Livewire\Front\ThankYou;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

Route::get('/', FrontIndex::class)->name('front.index');
Route::get('/catalog', CatalogIndex::class)->name('front.catalog');
Route::get('/categories', CategoryIndex::class)->name('front.categories');

Route::get('/races',  RaceIndex::class)->name('front.races');
Route::get('/racedetails/{slug}', RaceDetails::class)->name('front.raceDetails');

Route::get('/catalog/{slug}', [FrontController::class, 'productShow'])->name('front.product');
Route::get('/contact', [FrontController::class, 'contact'])->name('front.contact');
Route::get('/a-propos', [FrontController::class, 'about'])->name('front.about');
Route::get('/resources', BlogIndex::class)->name('front.blog');
Route::get('/resource/{slug}', BlogShow::class)->name('front.blogPage');
Route::get('/page/{slug}', DynamicPage::class)->name('front.dynamicPage');
Route::get('/generate-sitemap', [FrontController::class, 'generateSitemaps'])->name('generate-sitemaps');
Route::get('/redirect/{url}', [FrontController::class, 'redirect'])->name('redirect');

Route::get('/confirmation-shopping', CheckoutIndex::class)->name('front.checkout');

Route::get('/approval', function () {
    return view('auth.approval');
})->name('auth.approval');

Route::middleware('auth')->group(function () {
    Route::get('/confirmation-inscription', CheckoutRace::class)->name('front.checkout-race');
    Route::get('/thankyou/{id}', ThankYou::class)->name('front.thankyou');

    Route::get('/mon-compte', AccountIndex::class)->name('front.myaccount');
});

Route::post('/uploads', [UploadController::class, 'upload'])->name('upload');

Route::get('/cmi/pay/{id}', [CheckoutController::class, 'initiateCmiPayment'])->name('cmi.pay');
Route::post('/cmi/callback', [CheckoutController::class, 'callback'])->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
Route::post('/cmi/okUrl', [CheckoutController::class, 'okUrl'])->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
Route::post('/cmi/failUrl', [CheckoutController::class, 'failUrl'])->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

// Route::fallback(function (Request $request) {
//     return app()->make(ErrorController::class)->notFound($request);
// });

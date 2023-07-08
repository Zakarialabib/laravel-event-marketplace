<?php

declare(strict_types=1);

use App\Http\Controllers\ErrorController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Livewire\Front\Index as FrontIndex;
use App\Http\Livewire\Front\Categories as CategoryIndex;
use App\Http\Livewire\Front\Catalog as CatalogIndex;
use App\Http\Livewire\Front\Races as RacesIndex;
use App\Http\Livewire\Front\Checkout as CheckoutIndex;
use App\Http\Livewire\Front\CheckoutRace as CheckoutRace;
use App\Http\Livewire\Front\RaceDetails;
use App\Http\Controllers\UploadController;
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

Route::get('/races',  RacesIndex::class)->name('front.races');
Route::get('/racedetails/{slug}', RaceDetails::class)->name('front.raceDetails');

Route::get('/catalog/{slug}', [FrontController::class, 'productShow'])->name('front.product');
Route::get('/contact', [FrontController::class, 'contact'])->name('front.contact');
Route::get('/a-propos', [FrontController::class, 'about'])->name('front.about');
Route::get('/blog', [FrontController::class, 'blog'])->name('front.blog');
Route::get('/blog/{slug}', [FrontController::class, 'blogPage'])->name('front.blogPage');
Route::get('/page/{slug}', [FrontController::class, 'dynamicPage'])->name('front.dynamicPage');
Route::get('/generate-sitemap', [FrontController::class, 'generateSitemaps'])->name('generate-sitemaps');
Route::get('/redirect/{url}', [FrontController::class, 'redirect'])->name('redirect');

Route::get('/confirmation-shopping', CheckoutIndex::class)->name('front.checkout');

Route::get('/approval', function () {
    return view('auth.approval');
})->name('auth.approval');

Route::middleware('auth')->group(function () {
    
    Route::get('/confirmation-inscription', CheckoutRace::class)->name('front.checkout-race');
    
    Route::get('/mon-compte', [FrontController::class, 'myaccount'])->name('front.myaccount');
});

Route::post('/uploads', [UploadController::class, 'upload'])->name('upload');


// Route::fallback(function (Request $request) {
//     return app()->make(ErrorController::class)->notFound($request);
// });

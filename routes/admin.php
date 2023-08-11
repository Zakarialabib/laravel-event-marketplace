<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeaturedBannerController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SmptController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\Language\Index as LanguageIndex;
use App\Http\Livewire\Admin\Language\EditTranslation;
use App\Http\Livewire\Admin\Race\Index as RaceIndex;
use App\Http\Livewire\Admin\Race\Edit as RaceUpdate;
use App\Http\Livewire\Admin\RaceLocation\Index as RaceLocationIndex;
use App\Http\Livewire\Admin\Category\Index as CategoriesIndex;
use App\Http\Livewire\Admin\ProductCategory\Index as ProductCategoryIndex;
use App\Http\Livewire\Admin\Email\Index as EmailIndex;
use App\Http\Livewire\Admin\Menu\Index as MenuIndex;
use App\Http\Livewire\Admin\Backup\Index as BackupIndex;
use App\Http\Livewire\Admin\Shipping\Index as ShippingIndex;
use App\Http\Livewire\Admin\Registration\Index as RegistrationIndex;
use App\Http\Livewire\Admin\Participant\Index as ParticipantIndex;
use App\Http\Livewire\Admin\Participant\Show as ParticipantShow;
use App\Http\Livewire\Admin\Order\Index as OrderIndex;
use App\Http\Livewire\Admin\Order\Show as OrderShow;
use App\Http\Livewire\Admin\Service\Index as ServiceIndex;
use App\Http\Livewire\Admin\RaceResult\Index as RaceResultIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:admin']], function () {
    // change lang
    Route::get('/lang/{lang}', [DashboardController::class, 'changeLanguage'])->name('changelanguage');

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/categories', CategoriesIndex::class)->name('categories');
    Route::get('/product-categories', ProductCategoryIndex::class)->name('product-categories');

    Route::get('/subcategories', [CategoryController::class, 'subcategories'])->name('subcategories');
    Route::get('/brands', [BrandController::class, 'index'])->name('brands');
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/registrations', RegistrationIndex::class)->name('registrations');
    Route::get('/participants', ParticipantIndex::class)->name('participants');
    Route::get('/participant/{id}', ParticipantShow::class)->name('participant.show');
    Route::get('/orders', OrderIndex::class)->name('orders');
    Route::get('/order/{id}', OrderShow::class)->name('order.show');
    Route::get('/races', RaceIndex::class)->name('races');
    Route::get('/race/{name}', RaceUpdate::class)->name('race.update');
    Route::get('/racelocations', RaceLocationIndex::class)->name('racelocations');
    Route::get('/services', ServiceIndex::class)->name('services');
    Route::get('/race-results', RaceResultIndex::class)->name('race-results');
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/sections', [SectionController::class, 'index'])->name('sections');
    Route::get('/featuredBanners', [FeaturedBannerController::class, 'index'])->name('featuredBanners');
    Route::get('/pages', [PageController::class, 'index'])->name('pages');
    Route::get('/order-forms', [PageController::class, 'orderForms'])->name('orderforms');
    Route::get('/page/settings', [PageController::class, 'settings'])->name('page.settings');
    Route::get('/sliders', [SliderController::class, 'index'])->name('sliders');
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
    Route::get('/blog/category', [BlogCategoryController::class, 'index'])->name('blogcategories');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings');

    Route::get('/redirects', [SettingController::class, 'redirects'])->name('setting.redirects');

    Route::get('/report', [ReportController::class, 'index'])->name('report');

    Route::get('/notification', [NotificationController::class, 'index'])->name('notification');
    Route::get('/smpt', [SmptController::class, 'index'])->name('smpt');
    Route::get('/language', LanguageIndex::class)->name('language');
    Route::get('/shipping', ShippingIndex::class)->name('setting.shipping');
    Route::get('/backup', BackupIndex::class)->name('setting.backup');
    Route::get('/translation/{code}', EditTranslation::class)->name('translation');
    Route::get('/roles', [RolesController::class, 'index'])->name('roles');
    Route::get('/permissions', [UsersController::class, 'permissions'])->name('permissions');
    Route::get('/currencies', [SettingController::class, 'currencies'])->name('currencies');
    Route::get('/email-template', EmailIndex::class)->name('email-templates.index');
    Route::get('/menu-settings', MenuIndex::class)->name('menu-settings.index');
});

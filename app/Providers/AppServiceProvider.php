<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Language;
use App\Models\Settings;
use App\Observers\SettingsObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\App;
use App\Models\Contact;
use App\Models\Subscriber;
use App\Models\Registration;
use App\Observers\ContactObserver;
use App\Observers\OrderFormObserver;
use App\Observers\SubscriberObserver;
use App\Observers\RegistrationObserver;

class AppServiceProvider extends ServiceProvider
{
    /** Register any application services. */
    public function register(): void
    {
    }

    /** Bootstrap any application services. */
    public function boot(): void
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        View::share('languages', $this->getLanguages());

        Factory::macro('getImageUrl', static function (int $width, int $height): string {
            return sprintf(
                'https://picsum.photos/%d/%d',
                $width,
                $height
            );
        });

        Settings::observe(SettingsObserver::class);
        Contact::observe(ContactObserver::class);
        Contact::observe(OrderFormObserver::class);
        Subscriber::observe(SubscriberObserver::class);
        Registration::observe(RegistrationObserver::class);
        // Model::shouldBeStrict(! $this->app->isProduction());
    }

    private function getLanguages()
    {
        if ( ! Schema::hasTable('languages')) {
            return [];
        }

        return cache()->rememberForever('languages', static function () {
            return Language::pluck('name', 'code')->toArray();
        });
    }
}

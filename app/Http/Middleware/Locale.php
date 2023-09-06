<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Set config translatable.locales
        if (Schema::hasTable('languages')) {
            $languages = Language::query()
                ->where('status', true)
                ->get()->toArray();

            $language_default = Language::query()
                ->where('is_default', true)
                ->first();
        }

        $language_code = Session::get('language_code');

        if ($language_code) {
            App::setLocale($language_code);
        } else {
            App::setLocale($language_default['code']);
        }

        return $next($request);
    }
}

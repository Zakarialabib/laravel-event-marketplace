<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Redirect;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Enums\RedirectionStatus;
use Throwable;

class ErrorController extends Controller
{
    public function notFound(Request $request): RedirectResponse
    {
        try {
            $redirect = Redirect::where('old_url', $request->url())->first();

            if ($redirect) {
                return redirect($redirect->new_url, RedirectionStatus::TEMPORARY_REDIRECT);
            }

            $redirect = Redirect::create([
                'old_url'          => $request->url(),
                'new_url'          => url('/'),
                'http_status_code' => RedirectionStatus::MOVED_PERMANENTLY,
            ]);

            return redirect($redirect->new_url, $redirect->http_status_code);
        } catch (Throwable) {
            return redirect(url('/'));
        }
    }
}

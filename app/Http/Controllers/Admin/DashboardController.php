<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function changeLanguage($locale)
    {
        Session::put('code', $locale);
        $language = Session::get('code');

        return redirect()->back();
    }
}

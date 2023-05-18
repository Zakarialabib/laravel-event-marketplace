<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $customData = [
            'today' => [
                'countCustomers' => User::whereDate('created_at', '>=', Carbon::now())->count(),

            ],
            'month' => [
                'countCustomers' => User::whereDate('created_at', '>=', Carbon::now()->subMonth())->count(),

            ],
            'semi' => [
                'countCustomers' => User::whereDate('created_at', '>=', Carbon::now()->subMonths(6))->count(),
            ],
            'year' => [
                'countCustomers' => User::whereDate('created_at', '>=', Carbon::now()->subYear())->count(),
            ],
        ];

        $recentUsers = User::latest('id')->take(5)->get();

        return view('admin.dashboard', compact('customData', 'recentUsers'));
    }

    public function profile()
    {
        $data = Auth::user();

        return view('admin.profile', compact('data'));
    }

    public function passwordreset()
    {
        $data = Auth::user();

        return view('admin.password', compact('data'));
    }

    public function changepass(Request $request)
    {
        $admin = Auth::user();

        if ($request->cpass) {
            if (Hash::check($request->cpass, $admin->password)) {
                if ($request->newpass === $request->renewpass) {
                    $input['password'] = Hash::make($request->newpass);
                } else {
                    return response()->json(['errors' => [0 => __('Confirm password does not match.')]]);
                }
            } else {
                return response()->json(['errors' => [0 => __('Current password Does not match.')]]);
            }
        }
        $admin->update($input);
        $msg = __('Successfully changed your password');

        return response()->json($msg);
    }

    public function changeLanguage($locale)
    {
        Session::put('code', $locale);
        $language = Session::get('code');

        return redirect()->back();
    }
}

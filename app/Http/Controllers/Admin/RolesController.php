<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;

class RolesController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('access_user_management'), 403);

        return view('admin.roles.index');
    }
}

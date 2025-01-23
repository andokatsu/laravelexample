<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function redirectToDashboard()
    {
        $role = Auth::user()->role;

        switch ($role) {
            case 'admin':
                return view('admin.dashboard');
            case 'organizer':
                return view('organizer.dashboard');
            case 'user':
                return view('user.dashboard');
            default:
                abort(403, 'Unauthorized action.');
        }
    }
}


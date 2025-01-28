<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function redirectToDashboard()
    {
        $user = Auth::user();
        $role = $user->role;

        switch ($role) {
            case 'admin':
                return view('admin.dashboard', compact('user'));
            case 'organizer':
                return view('organizer.dashboard', compact('user'));
            case 'user':
                return view('user.dashboard', compact('user'));
            default:
                abort(403, 'Unauthorized action.');
        }
    }
}
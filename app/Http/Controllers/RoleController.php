<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Event;

class RoleController extends Controller
{
    public function redirectToDashboard()
    {
        $user = Auth::user();
        $role = $user->role;

        switch ($role) {
            case 'admin':
                $totalEvents = Event::count();
                $totalParticipants = Event::withCount('users')->get()->sum('users_count');
                $totalCancellations = Event::withCount(['users' => function ($query) {
                    $query->where('event_user.cancelled', true);
                }])->get()->sum('users_count');
                $popularEvents = Event::withCount('users')->orderBy('users_count', 'desc')->take(5)->get();
                return view('admin.dashboard', compact('user', 'totalEvents', 'totalParticipants', 'totalCancellations', 'popularEvents'));
            case 'organizer':
                $totalEvents = Event::where('organizer_id', $user->id)->count();
                $totalParticipants = Event::where('organizer_id', $user->id)->withCount('users')->get()->sum('users_count');
                $totalCancellations = Event::where('organizer_id', $user->id)->withCount(['users' => function ($query) {
                    $query->where('event_user.cancelled', true);
                }])->get()->sum('users_count');
                $popularEvents = Event::where('organizer_id', $user->id)->withCount('users')->orderBy('users_count', 'desc')->take(5)->get();
                $events = Event::where('organizer_id', $user->id)->get();
                return view('organizer.dashboard', compact('user', 'totalEvents', 'totalParticipants', 'totalCancellations', 'popularEvents', 'events'));
            case 'user':
                return view('user.dashboard', compact('user'));
            default:
                abort(403, 'Unauthorized action.');
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Event;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'review' => 'required|string|max:1000',
        ]);

        Review::create([
            'event_id' => $event->id,
            'user_id' => Auth::id(),
            'review' => $request->review,
        ]);

        return redirect()->route('events.show', $event)->with('success', 'レビューが投稿されました。');
    }
}

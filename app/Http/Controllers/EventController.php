<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'details' => 'required|string',
            'max_capacity' => 'required|integer|min:1',
        ]);

        Event::create([
            'title' => $request->title,
            'date' => $request->date,
            'location' => $request->location,
            'details' => $request->details,
            'organizer_id' => Auth::id(),
            'max_capacity' => $request->max_capacity,
        ]);

        return redirect()->route('events.index')->with('success', 'イベントが作成されました。');
    }

    public function edit(Event $event)
    {
        $this->authorize('view', $event); // viewポリシーを使用して表示権限を確認
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'details' => 'required|string',
            'max_capacity' => 'required|integer|min:1',
        ]);

        $event->update([
            'title' => $request->title,
            'date' => $request->date,
            'location' => $request->location,
            'details' => $request->details,
            'max_capacity' => $request->max_capacity,
        ]);

        return redirect()->route('events.index')->with('success', 'イベントが更新されました。');
    }

    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);
        $event->delete();
        return redirect()->route('events.index')->with('success', 'イベントが削除されました。');
    }

    public function calendar()
    {
        $events = Event::all()->map(function ($event) {
            return [
                'title' => $event->title,
                'start' => $event->date . 'T00:00:00', // ISO8601形式
                'url' => route('events.show', $event->id)
            ];
        })->toArray(); // Laravel 5.7 では toArray() を追加

        return view('events.calendar', ['events' => $events]);
    }

    public function show(Event $event)
    {
        $isRegistered = $event->users()->where('user_id', Auth::id())->exists();
        return view('events.show', compact('event', 'isRegistered'));
    }

    // 新しい機能の追加
    public function register(Event $event)
    {
        $event->users()->attach(Auth::id());
        return redirect()->back()->with('success', 'イベントに参加登録しました。');
    }

    public function cancel(Event $event)
    {
        $event->users()->detach(Auth::id());
        return redirect()->back()->with('success', 'イベントの参加をキャンセルしました。');
    }

    public function participants(Event $event)
    {
        $participants = $event->users;
        return view('events.participants', compact('event', 'participants'));
    }

    public function exportCsv(Event $event)
    {
        $participants = $event->users;
        $csvData = "名前,メールアドレス\n";

        foreach ($participants as $participant) {
            $csvData .= "{$participant->name},{$participant->email}\n";
        }

        $fileName = "participants_{$event->id}.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        return Response::make($csvData, 200, $headers);
    }
}

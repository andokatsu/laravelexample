<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // イベント作成フォーム
    public function create()
    {
        return view('events.create');
    }

    // イベントの保存
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'details' => 'required|string',
            'max_capacity' => 'required|integer',
        ]);

        // イベントの作成
        Event::create([
            'title' => $request->title,
            'date' => $request->date,
            'location' => $request->location,
            'details' => $request->details,
            'organizer_id' => Auth::id(),
            'max_capacity' => $request->max_capacity,
        ]);

        return redirect()->route('events.index')->with('success', 'イベントが作成されました');
    }

    // イベント編集フォーム
    public function edit($id)
    {
        $event = Event::findOrFail($id);

        if ($event->organizer_id !== Auth::id()) {
            abort(403, 'アクセス権がありません');
        }

        return view('events.edit', compact('event'));
    }

    // イベントの更新
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'details' => 'required|string',
            'max_capacity' => 'required|integer',
        ]);

        // イベントの更新
        $event = Event::findOrFail($id);

        if ($event->organizer_id !== Auth::id()) {
            abort(403, 'アクセス権がありません');
        }

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'イベントが更新されました');
    }

    // イベントの削除
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->organizer_id !== Auth::id()) {
            abort(403, 'アクセス権がありません');
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'イベントが削除されました');
    }

    // イベント参加機能
    public function register($id)
    {
        $event = Event::findOrFail($id);

        if ($event->current_capacity >= $event->max_capacity) {
            return back()->with('error', '定員に達しました');
        }

        // 参加人数を増加
        $event->current_capacity++;
        $event->save();

        return back()->with('success', 'イベントに参加しました');
    }

}

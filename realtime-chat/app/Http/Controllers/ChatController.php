<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        auth()->user()->update([
            'last_seen' => now(),
        ]);

        $users = User::where('id', '!=', auth()->id())->get();

        $groups = auth()->user()->groups;

        $messages = collect();

        $selectedUser = null;
        $selectedGroup = null;

        return view('chat.index', compact(
            'users',
            'groups',
            'messages',
            'selectedUser',
            'selectedGroup'
        ));
    }

    public function showUser($id)
    {
        auth()->user()->update([
            'last_seen' => now(),
        ]);

        $users = User::where('id', '!=', auth()->id())->get();

        $groups = auth()->user()->groups;

        $selectedUser = User::findOrFail($id);

        $selectedGroup = null;

        $messages = Message::where(function ($query) use ($id) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $id);
        })
        ->orWhere(function ($query) use ($id) {
            $query->where('sender_id', $id)
                  ->where('receiver_id', auth()->id());
        })
        ->orderBy('created_at')
        ->get();

        return view('chat.index', compact(
            'users',
            'groups',
            'messages',
            'selectedUser',
            'selectedGroup'
        ));
    }

    public function showGroup($id)
    {
        auth()->user()->update([
            'last_seen' => now(),
        ]);

        $users = User::where('id', '!=', auth()->id())->get();

        $groups = auth()->user()->groups;

        $selectedGroup = Group::with('users')->findOrFail($id);

        $selectedUser = null;

        $messages = Message::where('group_id', $id)
            ->orderBy('created_at')
            ->get();

        return view('chat.index', compact(
            'users',
            'groups',
            'messages',
            'selectedUser',
            'selectedGroup'
        ));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'group_id' => $request->group_id,
            'message' => $request->message,
        ]);

        if ($request->group_id) {
            return redirect()->route('chat.group', $request->group_id);
        }

        return redirect()->route('chat.user', $request->receiver_id);
    }
}
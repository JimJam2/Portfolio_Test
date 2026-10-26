<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageController extends Controller
{
    /**
     * Display a listing of messages.
     */
    public function index(Request $request): View
    {
        $query = Message::latest();

        if ($request->has('filter') && $request->input('filter') === 'unread') {
            $query->where('is_read', false);
        }

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search): void {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $messages = $query->paginate(15)->withQueryString();
        $unreadCount = Message::where('is_read', false)->count();

        return view('admin.messages.index', compact('messages', 'unreadCount'));
    }

    /**
     * Display the specified message.
     */
    public function show(Message $message): View
    {
        if (! $message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Toggle read/unread status.
     */
    public function toggleRead(Message $message): RedirectResponse
    {
        $message->update([
            'is_read' => ! $message->is_read,
        ]);

        $statusText = $message->is_read ? 'ditandai sudah dibaca' : 'ditandai belum dibaca';

        return back()->with('success', "Pesan berhasil {$statusText}.");
    }

    /**
     * Remove the specified message from storage.
     */
    public function destroy(Message $message): RedirectResponse
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Pesan berhasil dihapus!');
    }
}

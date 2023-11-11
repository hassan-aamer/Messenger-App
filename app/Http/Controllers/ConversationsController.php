<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ConversationsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return $user->conversations()->paginate();
    }
    public function show(Conversation $conversation)
    {
        return $conversation->load('participants');
    }
    public function addParticipant(Request $request, Conversation $conversation)
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $conversation->participants()->attach($request->post('user_id'), [
            'joined_at' => Carbon::now(),
        ]);
    }
    public function removeParticipant(Request $request, Conversation $conversation)
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $conversation->participants()->detach($request->post('user_id'));
    }
}

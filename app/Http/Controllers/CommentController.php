<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Ticket;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function postComment(CommentRequest $request)
    {
        $ticket = Ticket::where('ticket_id', $request->input('ticket_id'))->firstOrFail();
        if ($ticket->user_id != Auth::id() && Auth::user()->role != 'admin') {
            return back()->with('status', 'Can\'t post comment to another ticket');
        }

        $comment = Comment::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::user()->id,
            'comment' => $request->input('comment')
        ]);

        if ($ticket->status == 'closed') {
            $ticket->status = 'open';
            $ticket->save();
        }

        return redirect()->back()->with("status", "Your comment has been submitted.");
    }
}

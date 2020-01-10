<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Http\Requests\TicketRequest;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use stdClass;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $id = null)
    {
        $sortedTickets = new StdClass();
        $title = 'All Tickets';

        $tickets = Ticket::orderBy('updated_at', 'DESC')->get();

        /**
         * Get tickets sorted: unread, open, closed
         */
        $sortedTickets->unread = DB::table('tickets')
            ->join('users', 'tickets.user_id', 'users.id')
            ->join('comments', function ($join) {
                $join->on('tickets.user_id', 'comments.user_id')
                    ->on('tickets.id', 'comments.ticket_id');
            })
            ->select('tickets.*', 'users.role', 'comments.read_at', 'comments.ticket_id')
            ->where('comments.read_at', null)
            ->groupBy('comments.ticket_id')
            ->get();

        $sortedTickets->open = DB::table('tickets')
            ->where('status', '!=', 'closed')->get();


        $sortedTickets->closed = DB::table('tickets')
            ->where('status', 'closed')
            ->get();
        if (Auth::user()->role == 'admin' && $id == null) {
            $sortedTickets->unread = $sortedTickets->unread->where('role', '!=', 'admin');
        } else {
            $unreadOperation = '!=';
            if ($id == null) {
                $id = Auth::id();
                $unreadOperation = '=';
            }
            $tickets = $tickets->where('user_id', $id);
            $title = 'Tickets - ' . User::find($id)->email;

            $sortedTickets->unread = $sortedTickets->unread->where('user_id', $id)->where('role', $unreadOperation, 'admin');

            $sortedTickets->open = $sortedTickets->open->where('user_id', $id);;

            $sortedTickets->closed = $sortedTickets->closed->where('user_id', $id);
        }

        /**
         *  Filtering the tickets
         */
        $request = $request->all();
        if (isset($request['filter'])) {
            if ($request['filter'] != 'unread') {
                $tickets = $tickets->where('status', $request['filter']);
            }
        }

        return view('tickets.index')->with([
            'tickets' => $tickets,
            'cards' => $sortedTickets,
            'title' => $title,
        ]);
    }

    /**
     * Show the form for creating a new ticket.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }

    /**
     * Store a newly created ticket in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TicketRequest $request)
    {
        do {
            $token = strtoupper(Str::random(10));
            $ticket = Ticket::where('ticket_id', $token)->first();
        } while (!empty($ticket));

        $ticket = new Ticket([
            'ticket_id' => $token,
            'user_id' => Auth::id(),
            'category_id' => $request->input('category'),
            'type' => $request->input('type'),
            'priority' => $request->input('priority'),
            'subject' => $request->input('subject'),
            'status' => 'open',
        ]);

        DB::beginTransaction();

        $ticket->save();
        $comment = new Comment([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'comment' => $request->input('message'),
        ]);
        $comment->save();

        DB::commit();

        return redirect(route('tickets.show', $ticket->ticket_id))->with("status", "Ticket with ID: #$ticket->ticket_id has been opened.");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $ticket = Ticket::where('ticket_id', $id)->firstOrFail();
        return view('tickets.show', compact('ticket'));
    }

    public function close($id)
    {
        $ticket = Ticket::where('ticket_id', $id)->firstOrFail();

        $ticket->status = "closed";

        $ticket->save();

        return redirect()->back()->with("status", "The ticket has been closed.");
    }
}

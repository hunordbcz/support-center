@extends('layouts.app')

@section('content')

    @include('layouts.headers.cards')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{ $title }}</h3>
                            </div>
                            <div class="col text-right">
                                {{--                                <a href="#!" class="btn btn-sm btn-primary">See all</a>--}}
                                @if(Auth::user()->role != 'admin')
                                    <a href="{{route('tickets.create')}}" class="btn btn-sm btn-primary">Submit a new
                                        Ticket</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Ticket ID</th>
                                <th scope="col">Subject</th>
                                @if(Auth::user()->role == 'admin')
                                    <th scope="col">User</th>
                                @endif
                                <th scope="col">Last Update</th>
                                <th scope="col">Last Replier</th>
                                <th scope="col">Category</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Priority</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $ticket)
                                @php
                                    if(request()->has('filter') && request()->input('filter') == 'unread' && !$cards->unread->contains('id', $ticket->id)) continue;
                                @endphp
                                <tr>
                                    <th scope="row">
                                        @if($cards->unread->contains('id', $ticket->id))
                                            {{--                                        @if($ticket->comments->contains('read_at', null) && $ticket->comments->last->)--}}
                                            <span class="badge badge-info">Unread</span>
                                        @endif
                                        {{ $ticket->ticket_id }}
                                    </th>
                                    <td>{{ $ticket->subject }}</td>
                                    @if(Auth::user()->role == 'admin')
                                        <td>
                                            <a href="{{route('user.edit', $ticket->user->id)}}"> {{ $ticket->user->name }}</a>
                                        </td>
                                    @endif
                                    <td>{{ $ticket->updated_at }}</td>
                                    <td>{{ count($ticket->comments) ? $ticket->comments->last()->user->name : $ticket->user->name }}</td>
                                    <td>{{ $ticket->category->name }}</td>
                                    <td>{{ $ticket->type }}</td>
                                    <td>
                                        @if($ticket->status == 'open')
                                            <span class="badge badge-success">Open</span>
                                        @elseif($ticket->status == 'answered')
                                            <span class="badge badge-primary">Answered</span>
                                        @elseif($ticket->status == 'closed')
                                            <span class="badge badge-default">Closed</span>
                                        @else
                                            n/a
                                        @endif
                                    </td>
                                    <td>
                                        @if($ticket->priority == 'normal')
                                            <span class="badge badge-info">Normal</span>
                                        @elseif($ticket->priority == 'medium')
                                            <span class="badge badge-primary">Medium</span>
                                        @elseif($ticket->priority == 'high')
                                            <span class="badge badge-default">High</span>
                                        @elseif($ticket->priority == 'urgent')
                                            <span class="badge badge-warning">Urgent</span>
                                        @elseif($ticket->priority == 'critical')
                                            <span class="badge badge-danger">Critical</span>
                                        @else
                                            n/a
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('tickets.show', $ticket->ticket_id) }}"
                                           class="btn btn-sm btn-icon btn-3 btn-primary" type="button">
                                            <span class="btn-inner--icon"><i class="far fa-eye"></i></span>
                                            <span class="btn-inner--text">View</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

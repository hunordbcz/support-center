<div class="row">
    <div class="col-xl-12 mb-5 mb-xl-0">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="mb-0">{{ $ticket->subject }}</h2>
                    </div>

                    <div class="col text-right">
                        <a class="btn btn-sm btn-outline-success {{ $errors->has('comment') ? '' : 'collapsed' }}"
                           data-toggle="collapse" href="#sendMessage"
                           role="button" aria-expanded="{{ $errors->has('comment') ? 'true' : 'false' }}"
                           aria-controls="sendMessage">
                            {{__('Reply')}}
                        </a>
                        @if($ticket->status != 'closed')
                            {{--                                <a href="#!" class="btn btn-sm btn-primary">See all</a>--}}
                            <a href="{{route('tickets.close', $ticket->ticket_id)}}"
                               class="btn btn-sm btn-outline-danger"
                               onclick="return confirm('{{ __("Are you sure you want to close this ticket?") }}')">Close
                                Ticket</a>
                        @endif
                        <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home')  }}"
                           class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                    </div>
                </div>
                @include('tickets.reply')
            </div>
            <div class="list-group list-group-flush">
                @foreach($ticket->comments as $comment)
                    @php
                        if($comment->user_id != Auth::id() && $comment->read_at == null)
                            $comment->markAsRead();
                    @endphp
                    <div class="list-group-item flex-column align-items-start py-4 px-4">
                        <div class="d-flex w-100 justify-content-between">
                            <div>
                                <div class="d-flex w-100 align-items-center">
                                    {{--                                            <img src="/docs/assets/img/theme/team-1.jpg" alt="r"--}}
                                    {{--                                            class="avatar avatar-xs mr-2"/>--}}
                                    <h3 class="m-0">{{ ucwords($comment->user->name) }}</h3>
                                    <span
                                        class="ml-2 badge badge-{{ $comment->user->role == 'admin' ? 'primary' : 'default'}}">{{ $comment->user->role == 'admin' ? 'Staff' : 'User'}}</span>
                                </div>
                            </div>
                            <small>Posted on: {{$comment->created_at->toDayDateTimeString()}}</small>
                        </div>
                        <p class="mt-3">
                            {!! nl2br(e($comment->comment)) !!}
                        </p>
                        @if($comment->read_at)
                            <small class="fa-pull-right text-gray">Read
                                on: {{$comment->read_at->toDayDateTimeString()}}</small>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

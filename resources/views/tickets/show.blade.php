@extends('layouts.app')

@section('title', $ticket->title)

@section('content')
    @php
        switch ($ticket->status){
            case 'open':
                $status_color = 'success';
                break;
            case 'answered':
                $status_color = 'primary';
                break;
            default:
                $status_color = 'dark';
                break;
        }

        switch ($ticket->priority){
            case 'medium':
                $priority_color = 'primary';
                break;
            case 'high':
                $priority_color = 'default';
                break;
            case 'urgent':
                $priority_color = 'warning';
                break;
            case 'critical':
                $priority_color = 'danger';
                break;
            default:
                $priority_color = 'info';
                break;
        }
    @endphp

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row mt-3 text-center">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0 bg-default">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-white mb-0">Department</h5>
                                        <span
                                            class="h2 font-weight-bold text-white mb-0">{{ $ticket->category->name }}</span>
                                    </div>
                                    {{--                                    <div class="col-auto">--}}
                                    {{--                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">--}}
                                    {{--                                            <i class="fas fa-certificate"></i>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                </div>
                                {{--                                <p class="mt-3 mb-0 text-muted text-sm">--}}
                                {{--                                    <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>--}}
                                {{--                                    <span class="text-nowrap">Since yesterday</span>--}}
                                {{--                                    <button class="btn btn-sm btn-outline-primary fa-pull-right">--}}
                                {{--                                        Show--}}
                                {{--                                    </button>--}}
                                {{--                                </p>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0 bg-default">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-white mb-0">Type</h5>
                                        <span
                                            class="h2 font-weight-bold text-white mb-0">{{ ucfirst($ticket->type) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0 bg-{{$status_color}}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-white mb-0">Status</h5>
                                        <span
                                            class="h2 font-weight-bold text-white mb-0">{{ ucfirst($ticket->status) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0 bg-{{$priority_color}}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-white mb-0">Priority</h5>
                                        <span
                                            class="h2 font-weight-bold text-white mb-0">{{ ucfirst($ticket->priority) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid mt--7">

        <div class="col-12">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        @include('tickets.comments')

        @include('layouts.footers.auth')

    </div>
@endsection

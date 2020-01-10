<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            @if(isset($cards))
                <div class="row mt-3">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0 bg-color-comes-here">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Unread Tickets</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ count($cards->unread) }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-certificate"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <a href="{{ route('home',['filter' => 'unread']) }}"
                                       class="btn btn-block btn-sm btn-outline-primary fa-pull-right">
                                        Show
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Open Tickets</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ count($cards->open) }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                            <i class="fas fa-question"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <a href="{{ route('home',['filter' => 'open']) }}"
                                       class="btn btn-block btn-sm btn-outline-primary fa-pull-right">
                                        Show
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Closed Tickets</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ count($cards->closed) }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                                            <i class="fas fa-check-double"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <a href="{{ route('home',['filter' => 'closed']) }}"
                                       class="btn btn-block btn-sm btn-outline-primary fa-pull-right">
                                        Show
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Tickets</h5>
                                        <span
                                            class="h2 font-weight-bold mb-0">{{ count($cards->open) + count($cards->closed) }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <a href="{{ route('home') }}"
                                       class="btn btn-block btn-sm btn-outline-primary fa-pull-right">
                                        Show
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Submit a new Ticket'), 'description' => __('If you can\'t find a solution to your problem in our knowledgebase, you can submit a ticket by selecting the appropriate department below.')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('If you are reporting a problem, please remember to provide as much information that is relevant to the issue as possible.') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home')  }}"
                                   class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('tickets.store') }}" autocomplete="off">
                            @csrf
                            @method('POST')
                            <h6 class="heading-small text-muted">{{ __('Departments') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                                    @foreach($categories as $category)
                                        <div class="custom-control custom-radio mb-3">
                                            <input name="category" class="custom-control-input" id="{{ $category->id }}"
                                                   value="{{ $category->id }}"
                                                   {{ old('category') == $category->id ? 'checked' : '' }} type="radio">
                                            <label class="custom-control-label"
                                                   for="{{ $category->id }}">{{ ucfirst($category->name) }}</label>
                                        </div>
                                    @endforeach
                                    @if ($errors->has('category'))
                                        <div class="d-block invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <h6 class="heading-small text-muted mt-5">{{ __('General Information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-type">{{ __('Type') }}</label>
                                    <select
                                        class="custom-select form-control-alternative {{ $errors->has('type') ? ' is-invalid' : '' }}"
                                        name="type" id="input-type">
                                        <option
                                            value="issue" {{ old('type') == 'issue' ? 'selected' : '' }}>{{__('Issue')}}</option>
                                        <option
                                            value="bug" {{ old('type') == 'bug' ? 'selected' : '' }}>{{__('Bug')}}</option>
                                        <option
                                            value="feedback" {{ old('type') == 'feedback' ? 'selected' : '' }}>{{__('Feedback')}}</option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('priority') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-priority">{{ __('Priority') }}</label>
                                    <select
                                        class="custom-select form-control-alternative {{ $errors->has('priority') ? ' is-invalid' : '' }}"
                                        name="priority" id="input-priority">
                                        <option
                                            value="normal" {{ old('priority') == 'normal' ? 'selected' : '' }}>{{__('Normal')}}</option>
                                        <option value="medium"
                                                class="text-primary" {{ old('priority') == 'medium' ? 'selected' : '' }}>{{__('Medium')}}</option>
                                        <option value="high"
                                                class="text-default" {{ old('priority') == 'high' ? 'selected' : '' }}>{{__('High')}}</option>
                                        <option value="urgent"
                                                class="text-warning" {{ old('priority') == 'urgent' ? 'selected' : '' }}>{{__('Urgent')}}</option>
                                        <option value="critical"
                                                class="text-danger" {{ old('priority') == 'critical' ? 'selected' : '' }}>{{__('Critical')}}</option>
                                    </select>
                                    @if ($errors->has('priority'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('priority') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <h6 class="heading-small text-muted mt-5">{{ __('Your Message') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('subject') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-subject">{{ __('Subject') }}</label>
                                    <input type="text" name="subject" id="input-subject"
                                           class="form-control form-control-alternative{{ $errors->has('subject') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Subject') }}" value="{{ old('subject') }}" required>

                                    @if ($errors->has('subject'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('message') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-message">{{ __('Message') }}</label>
                                    <textarea name="message" id="input-message"
                                              class="form-control form-control-alternative {{ $errors->has('message') ? ' is-invalid' : '' }}"
                                              rows="8" placeholder="{{__('Your message goes here ...')}}"
                                              value="{{ nl2br(e( old('message'))) }}" required></textarea>
                                    @if ($errors->has('message'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('message') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit"
                                            class="btn btn-block btn-success mt-4">{{ __('Submit') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

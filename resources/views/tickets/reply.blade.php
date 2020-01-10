<div class="collapse mt-3 {{ $errors->has('comment') ? 'show' : '' }}" id="sendMessage">
    <form method="post" action="{{ route('comment.post') }}" autocomplete="off">
        @csrf
        @method('POST')

        <div class="form-group{{ $errors->has('comment') ? ' has-danger' : '' }}">
            <label class="form-control-label"
                   for="input-comment">{{ __('Message') }}</label>
            <input type="hidden" name="ticket_id" value="{{$ticket->ticket_id}}">
            <textarea name="comment" id="input-comment"
                      class="form-control form-control-alternative {{ $errors->has('comment') ? ' is-invalid' : '' }}"
                      rows="8" placeholder="{{__('Your message goes here ...')}}"
                      value="{{ nl2br(e( old('comment'))) }}" required></textarea>
            @if($ticket->status == 'closed')
                <small class="text-warning">{{__('By replying, you will re-open the ticket.')}}</small>
            @endif
            @if ($errors->has('comment'))
                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('comment') }}</strong>
                                            </span>
            @endif
        </div>
        <div class="text-center">
            <button type="submit"
                    class="btn btn-block btn-success mt-4">{{ __('Add Reply') }}</button>
        </div>
    </form>
    <hr>
</div>

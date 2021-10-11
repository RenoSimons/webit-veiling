<div class="mt-2" id="feedback-message">
    <div class="msg-succes">
        @if(Session::has('success'))
        <div class="alert alert-success">
            <span>{{Session::get('success')}}</span>
        </div>
        @endif
    </div>
    <div class="msg-error">
        @if($errors->any())
        {!! implode('', $errors->all('<span class="alert alert-danger">:message</span>')) !!}
        @endif
    </div>
</div>
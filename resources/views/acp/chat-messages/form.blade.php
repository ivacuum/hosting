@include('tpl.form_errors')

{!! Form::radio('status')->required()->values(App\Domain\ChatMessageStatus::labels())->html() !!}

{!! Form::textarea('text')->required()->wide()->html() !!}

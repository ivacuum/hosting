@include('tpl.form_errors')

{{ Form::radio('status')->required()->values(App\Domain\ChatMessageStatus::labels()) }}

{{ Form::textarea('text')->required()->wide() }}

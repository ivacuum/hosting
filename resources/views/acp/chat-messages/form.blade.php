@include('tpl.form_errors')

{!! Form::radio('status')->required()->values([
  App\ChatMessage::STATUS_HIDDEN => 'Скрыто',
  App\ChatMessage::STATUS_PUBLISHED => 'Опубликовано',
])->html() !!}

{!! Form::textarea('text')->required()->wide()->html() !!}

@include('tpl.form_errors')

{!! Form::radio('status')->required()->values([
  App\Comment::STATUS_HIDDEN => 'Скрыт',
  App\Comment::STATUS_PUBLISHED => 'Опубликован',
  App\Comment::STATUS_PENDING => 'Ожидает активации',
])->html() !!}

{!! Form::textarea('html')->wide()->required()->html() !!}

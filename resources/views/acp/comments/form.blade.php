@include('tpl.form_errors')

{!! Form::radio('status')->required()->values([
  App\Comment::STATUS_HIDDEN => 'Скрыт',
  App\Comment::STATUS_PUBLISHED => 'Опубликован',
])->html() !!}

{!! Form::textarea('html')->wide()->required()->html() !!}

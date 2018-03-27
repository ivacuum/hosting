@include('tpl.form_errors')

{!! Form::text('title')->required()->html() !!}

{!! Form::radio('status')->required()->values([
  App\News::STATUS_HIDDEN => 'Скрыта',
  App\News::STATUS_PUBLISHED => 'Опубликована',
])->html() !!}

{!! Form::textarea('markdown')->wide()->required()->html() !!}

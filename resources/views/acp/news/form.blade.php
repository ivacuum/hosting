@include('tpl.form_errors')

{!! Form::radio('site_id')->required()->values([
  11 => 'vacuum.name',
  12 => 'vacuum.name/en',
])->html() !!}

{!! Form::text('title')->required()->html() !!}

{!! Form::radio('status')->required()->values([
  App\News::STATUS_HIDDEN => 'Скрыта',
  App\News::STATUS_PUBLISHED => 'Опубликована',
])->html() !!}

{!! Form::textarea('markdown')->wide()->required()->html() !!}

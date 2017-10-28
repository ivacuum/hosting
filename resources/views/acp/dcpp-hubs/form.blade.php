{!! Form::text('title')->required()->html() !!}
{!! Form::text('address')->required()->html() !!}
{!! Form::text('port')->required()->default(411)->html() !!}

{!! Form::radio('status')->required()->values([
  App\DcppHub::STATUS_HIDDEN => 'Скрыт',
  App\DcppHub::STATUS_PUBLISHED => 'Опубликован',
  App\DcppHub::STATUS_DELETED => 'Удален',
])->html() !!}

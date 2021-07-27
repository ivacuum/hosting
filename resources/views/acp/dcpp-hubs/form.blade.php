{!! Form::text('title')->required()->html() !!}
{!! Form::text('address')->required()->html() !!}
{!! Form::text('port')->required()->default(411)->html() !!}

{!! Form::radio('status')->required()->values(App\Domain\DcppHubStatus::cases())->html() !!}

@include('tpl.form_errors')

{!! Form::text('email')->required()->html() !!}
{!! Form::checkbox('status')
  ->default(App\Domain\UserStatus::Inactive->value)
  ->values([App\Domain\UserStatus::Active->value => 'Активен'])
  ->html() !!}

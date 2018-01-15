@include('tpl.form_errors')

{!! Form::text('email')->required()->html() !!}
{!! Form::checkbox('status')
  ->default(App\User::STATUS_INACTIVE)
  ->values([App\User::STATUS_ACTIVE => 'Активен'])
  ->html() !!}

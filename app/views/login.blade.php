@extends('base')

@section('content')
@if ($errors->has())
	<div class="alert alert-danger">
		{{ HTML::ul($errors->all()) }}
	</div>
@endif

<div class="boxed-group form-signin">
	<h3>Вход на сайт</h3>
	<div class="boxed-group-inner">
		{{ Form::open(['route' => 'login', 'method' => 'post']) }}
		
		<div class="form-group">
			{{ Form::label('email', 'Электронная почта:') }}
			{{ Form::email('email', null, ['class' => 'form-control']) }}
		</div>

		<div class="form-group">
			{{ Form::label('password', 'Пароль:') }}
			{{ Form::password('password', ['class' => 'form-control']) }}
		</div>
		
		<div class="checkbox">
			<label>{{ Form::checkbox('foreign') }} Чужой компьютер?</label>
		</div>
		
		{{ Form::submit('Войти', ['class' => 'btn btn-primary btn-lg']) }}
		{{ Form::close() }}
	</div>
</div>
@stop

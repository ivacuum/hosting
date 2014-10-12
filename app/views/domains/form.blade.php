@if ($errors->has())
	<div class="alert alert-danger">
		{{ HTML::ul($errors->all()) }}
	</div>
@endif

<div class="form-group {{ $errors->has('domain') ? 'has-error' : '' }}">
	{{ Form::label('domain', 'Домен:') }}
	{{ Form::text('domain', null, ['class' => 'form-control', 'placeholder' => 'example.com']) }}
</div>

<div class="form-group">
	{{ Form::select('client_id', Client::find(1)->lists('name', 'id'), null, ['class' => 'form-control']) }}
</div>

<div class="checkbox">
	{{ Form::hidden('active', 0) }}
	<label>{{ Form::checkbox('active') }} Мониторинг домена</label>
</div>

<div class="checkbox">
	{{ Form::hidden('domain_control', 0) }}
	<label>{{ Form::checkbox('domain_control')}} Домен в нашей панели</label>
</div>
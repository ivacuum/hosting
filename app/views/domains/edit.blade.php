@extends('base')

@section('content')
<p><a href="{{ route('domains.index') }}">&larr; Вернуться к списку доменов</a></p>

{{ Form::model($domain, ['route' => ['domains.update', $domain->domain], 'method' => 'put']) }}

@include('domains.form')

{{ Form::submit('Обновить информацию', ['class' => 'btn btn-primary']) }}

{{ Form::close() }}

@stop
@extends('base')

@section('content')
<p><a href="{{ route('domains.index') }}">&larr; Вернуться к списку доменов</a></p>

{{ Form::open(['route' => 'domains.store']) }}

@include('domains.form')

{{ Form::submit('Добавить домен', ['class' => 'btn btn-primary']) }}

{{ Form::close() }}

@stop
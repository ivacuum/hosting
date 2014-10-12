@extends('base')

@section('global_menu')
<li><a href="{{ route('acp.clients.index') }}">Клиенты</a></li>
@parent
@stop
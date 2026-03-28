@extends(view()->exists("$tpl.base") ? "$tpl.base" : 'acp.layout')

@section('content')
@include("$tpl.form")
@endsection

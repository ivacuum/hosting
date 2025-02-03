@extends(view()->exists("$tpl.base") ? "$tpl.base" : 'acp.layout')
@include('livewire')

@section('content')
@include("$tpl.form")
@endsection

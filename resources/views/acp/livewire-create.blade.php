@extends('acp.base')
@include('livewire')

@section('content')
<h3 class="font-medium text-2xl mb-2">
  @include('acp.tpl.back')
  @lang("$tpl.create")
</h3>

@include("$tpl.form")
@endsection

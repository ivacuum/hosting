@extends('acp.base')

@section('content')
<div class="pull-right">
  @include('acp.tpl.delete', ['id' => $user])
</div>
<h2>
  @include('acp.tpl.back')
  {{ $user->email }}
  @include('acp.tpl.edit', ['id' => $user])
</h2>
@endsection

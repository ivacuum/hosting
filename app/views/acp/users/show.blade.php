@extends('acp.base')

@section('content')
<div class="pull-right">
	{{ Form::open(['action' => ["$self@destroy", $user->id], 'method' => 'delete']) }}
	  <div class="form-group">
      <button class="btn btn-default js-confirm" data-confirm="Запись будет удалена. Продолжить?" type="submit">
        <span class="glyphicon glyphicon-trash"></span>
      </button>
	  </div>
	{{ Form::close() }}
</div>
<h2>
	<a href="{{ action("$self@index") }}"><span class="glyphicon glyphicon-chevron-left"></span></a>
	{{ $user->email }}
	<a class="btn btn-default" href="{{ action("$self@edit", [$user->id, 'goto' => Request::fullUrl()]) }}">
		<span class="glyphicon glyphicon-pencil"></span>
	</a>
</h2>
@stop
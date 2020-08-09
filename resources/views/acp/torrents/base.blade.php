@extends('acp.layout')

@section('model_menu')
@component('tpl.list-group-item', ['href' => path([App\Http\Controllers\Acp\Users::class, 'show'], $model->user_id)])
  @lang("$tpl.user")
  @if ($model->user)
    <div class="text-xs text-muted">{{ $model->user->email }}</div>
  @endif
@endcomponent
@endsection

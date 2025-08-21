<?php
/**
 * @var \App\Domain\SocialMedia\Models\SocialMediaPost $model
 */
?>

@extends('acp.layout')

@section('model_menu')
@component('tpl.list-group-item', ['href' => Acp::show(new App\User, $model->user_id)])
  {{ ViewHelper::modelFieldTrans($modelTpl, 'user') }}
  @if ($model->user)
    <div class="text-xs text-gray-500">{{ $model->user->email }}</div>
  @endif
@endcomponent
@component('tpl.list-group-item', ['href' => Acp::show(new App\Domain\Life\Models\Photo, $model->photo_id)])
  {{ ViewHelper::modelFieldTrans($modelTpl, 'photo') }}
@endcomponent
@endsection

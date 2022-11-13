<?php /** @var \App\City $model */ ?>

@extends('acp.layout')

@section('model_menu')
@component('tpl.list-group-item', ['href' => Acp::show($model->country)])
  @lang('acp.countries.show')
  <div class="text-xs text-muted">{{ $model->country->title }}</div>
@endcomponent
@endsection

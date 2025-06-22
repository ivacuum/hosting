<?php
/**
 * @var \App\City $model
 */
?>
@extends('acp.show')

@section('content')
@if($model->hashtags)
  <p><strong>{{ ViewHelper::modelFieldTrans('city', 'hashtags') }}</strong>: {{ $model->hashtags }} {{ $model->country->hashtags }}</p>
@endif
@parent
@endsection

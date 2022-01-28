<?php /** @var \App\Image $model */ ?>

@extends('acp.show')

@section('content')
<div><img class="screenshot" src="{{ $model->originalSecretUrl() }}" alt=""></div>
@parent
@endsection

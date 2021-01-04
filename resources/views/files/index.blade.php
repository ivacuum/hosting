<?php /** @var \App\File $file */ ?>

@extends('base')

@section('content')
@if (sizeof($models))
  <table class="table-stats table-adaptive">
    <thead>
    <tr>
      <th class="md:text-right">{{ ViewHelper::modelFieldTrans('file', 'id') }}</th>
      <th>{{ ViewHelper::modelFieldTrans('file', 'title') }}</th>
      <th class="md:text-right">{{ ViewHelper::modelFieldTrans('file', 'size') }}</th>
      <th class="md:text-right">{{ ViewHelper::modelFieldTrans('file', 'downloads') }}</th>
      <th>{{ ViewHelper::modelFieldTrans('file', 'created_at') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($models as $file)
      <tr>
        <td class="md:text-right">{{ $file->id }}</td>
        <td>
          <a href="{{ to('files/{file}/dl', $file) }}">
            {{ $file->title }}
          </a>
        </td>
        <td class="md:text-right text-muted whitespace-nowrap">{{ ViewHelper::size($file->size) }}</td>
        <td class="md:text-right whitespace-nowrap">{{ ViewHelper::number($file->downloads) }}</td>
        <td>{{ ViewHelper::dateShort($file->created_at) }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endif

@include('tpl.paginator', ['paginator' => $models])
@endsection

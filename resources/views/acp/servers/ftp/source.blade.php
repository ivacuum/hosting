<?php
/** @var App\Server $server */
?>

@extends('acp.base')

@section('content')
<h2>
  <a href="/acp/servers/{{ $server->id }}">
    @svg (chevron-left)
  </a>
  ftp://{{ $server->host }}
</h2>

<h2>
  <a href="/acp/servers/{{ $server->id }}/ftp?dir={{ $dirUp }}">
    @svg (chevron-left)
  </a>
  {{ basename($file) }}
  <span class="text-base text-muted">{{ $dirUp }}</span>
</h2>

<form action="/acp/servers/{{ $server->id }}/ftp/source" method="post">
  {{ ViewHelper::inputHiddenMail() }}
  @csrf

  <div class="mb-4">
    <textarea
      class="form-input text-sm font-mono resize-none js-autosize-textarea"
      name="source"
      rows="2"
    >{{ $source }}</textarea>
  </div>

  <button class="btn btn-primary">
    Сохранить изменения
  </button>

  <input type="hidden" name="file" value="{{ $file }}">
</form>
@endsection

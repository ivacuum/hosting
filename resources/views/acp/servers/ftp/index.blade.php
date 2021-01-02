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

<h3>
  @if ($dirUp != ':')
    <a href="/acp/servers/{{ $server->id }}/ftp?dir={{ $dirUp }}">
      @svg (chevron-left)
    </a>
  @endif
  {{ $dir }}
</h3>
<table class="table-stats">
  @foreach ($dirs as $row)
    <tr>
      <td>
        @svg (folder-o)
        &nbsp;
        <a href="/acp/servers/{{ $server->id }}/ftp?dir={{ $row['path'] }}">{{ $row['basename'] }}</a>
      </td>
      <td></td>
      <td></td>
    </tr>
  @endforeach
  @foreach ($files as $row)
  <tr>
    <td>
      @svg (file-text-o)
      &nbsp;
      <a href="/acp/servers/{{ $server->id }}/ftp/source?file={{ $row['path'] }}">{{ $row['basename'] }}</a>
    </td>
    <td><span class="text-muted">{{ $row['size'] }} b</span></td>
    <td></td>
  </tr>
  @endforeach
</table>

<div class="max-w-500px mt-4">
  <form action="/acp/servers/{{ $server->id }}/ftp/file" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @csrf
    <div class="flex w-full">
      <input class="form-input mr-1" type="text" name="file" value="{{ old('file') }}">
      <button class="btn btn-default whitespace-nowrap">
        Создать файл
      </button>
    </div>

    <input type="hidden" name="path" value="{{ $dir }}">
  </form>

  <form class="mt-4" action="/acp/servers/{{ $server->id }}/ftp/dir" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @csrf

    <div class="flex w-full">
      <input class="form-input mr-1" type="text" name="dir" value="{{ old('dir') }}">
      <button class="btn btn-default whitespace-nowrap">
        Создать папку
      </button>
    </div>

    <input type="hidden" name="path" value="{{ $dir }}">
  </form>

  <form class="mt-4" action="/acp/servers/{{ $server->id }}/ftp/upload" enctype="multipart/form-data" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @csrf

    <div class="flex items-center w-full">
      <input class="mr-1" type="file" name="file">
      <button class="btn btn-default">
        Загрузить файл
      </button>
    </div>

    <input type="hidden" name="path" value="{{ $dir }}">
  </form>
</div>
@endsection

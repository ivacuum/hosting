@extends('acp.base')

@section('content')
<h2>
  <a href="/acp/servers/{{ $server->id }}">
    @include('tpl.svg.chevron-left')
  </a>
  ftp://{{ $server->host }}
</h2>

<div class="boxed-group flush">
  <h3>
    @if ($dir_up != ':')
      <a href="/acp/servers/{{ $server->id }}/ftp?dir={{ $dir_up }}">
        @include('tpl.svg.chevron-left')
      </a>
    @endif
    {{ $dir }}
  </h3>
  <div class="boxed-group-inner">
    <table class="table-stats">
      @foreach ($dirs as $row)
        <tr>
          <td>
            @include('tpl.svg.folder-o')
            &nbsp;
            <a href="/acp/servers/{{ $server->id }}/ftp?dir={{ $row['path'] }}" class="link">{{ $row['basename'] }}</a>
          </td>
          <td></td>
          <td></td>
        </tr>
      @endforeach
      @foreach ($files as $row)
      <tr>
        <td>
          @include('tpl.svg.file-text-o')
          &nbsp;
          <a href="/acp/servers/{{ $server->id }}/ftp/source?file={{ $row['path'] }}" class="link">{{ $row['basename'] }}</a>
        </td>
        <td><span class="text-muted">{{ $row['size'] }} b</span></td>
        <td></td>
      </tr>
      @endforeach
    </table>
  </div>
</div>



<form action="/acp/servers/{{ $server->id }}/ftp/file" method="post">
  <input type="text" class="input-type-check" name="mail" value="{{ old('mail') }}">
  <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
    <div class="input-group" style="width: 30em;">
      <input type="text" class="form-control" name="file" value="{{ old('file') }}">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-default">
          Создать файл
        </button>
      </span>
    </div>
  </div>

  <input type="hidden" name="path" value="{{ $dir }}">
  {{ csrf_field() }}
</form>

<form action="/acp/servers/{{ $server->id }}/ftp/dir" method="post">
  <input type="text" class="input-type-check" name="mail" value="{{ old('mail') }}">
  <div class="form-group {{ $errors->has('dir') ? 'has-error' : '' }}">
    <div class="input-group" style="width: 30em;">
      <input type="text" class="form-control" name="dir" value="{{ old('dir') }}">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-default">
          Создать папку
        </button>
      </span>
    </div>
  </div>

  <input type="hidden" name="path" value="{{ $dir }}">
  {{ csrf_field() }}
</form>

<form action="/acp/servers/{{ $server->id }}/ftp/upload" enctype="multipart/form-data" method="post">
  <input type="text" class="input-type-check" name="mail" value="{{ old('mail') }}">
  <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
    <div class="input-group" style="width: 30em;">
      <input type="file" class="form-control" name="file">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-default">
          Загрузить файл
        </button>
      </span>
    </div>
  </div>

  <input type="hidden" name="path" value="{{ $dir }}">
  {{ csrf_field() }}
</form>
@stop

@extends('base')

@section('global_menu')
<li>
  <a class="{{ $view === 'retracker.index' ? 'navbar-selected' : '' }}" href="{{ action('Retracker@index') }}">
    {{ trans('retracker.index') }}
  </a>
</li>
<li>
  <a class="{{ $view === 'retracker.usage' ? 'navbar-selected' : '' }}" href="{{ action('Retracker@usage') }}">
    {{ trans('retracker.usage') }}
  </a>
</li>
<li>
  <a class="{{ $view === 'retracker.dev' ? 'navbar-selected' : '' }}" href="{{ action('Retracker@dev') }}">
    {{ trans('retracker.dev') }}
  </a>
</li>
@endsection

@section('content_header')
<div class="row">
  <div class="col-md-3">
    <div class="text-center">
      <a href="{{ action('Retracker@index') }}">
        <img src="http://ivacuum.org/i/rt/logo.png" width="128" height="128">
      </a>
    </div>
    <h3>Ссылки</h3>
    <ul>
      <li><a class="link" href="{{ action('Files@download', 122) }}">Исходные коды ретрекера</a></li>
    </ul>
  </div>
  <div class="col-md-9">
@endsection

@section('content_footer')
  </div>
</div>
@endsection

@extends('dcpp.base')

@section('content')
<h1 class="mt-0">{{ trans('dcpp.download') }} {{ $software_title }} {{ $software[0]['version'] }}</h1>
@section('download_latest')
  <p>
    <a class="btn btn-success" href="{{ action('Files@download', $software[0]['id']) }}">
      @php ($icon = $software[0]['icon'] ?? 'windows')
      @svg ($icon)
      {{ trans('dcpp.download') }}{{ $software[0]['dl_suffix'] }}
      @if (!empty($software[0]['size']))
        &middot;
        {{ ViewHelper::size($software[0]['size']) }}
      @endif
    </a>
  </p>
@show

<section>
  <h2 class="mt-0">{{ trans('dcpp.about_software') }}</h2>
  @yield('about_software')
</section>

@if (!empty($software_screenshots))
  <section>
    <h2 class="mt-0">{{ trans('dcpp.screenshots') }}</h2>
    <p>
      @foreach ($software_screenshots as $screenshot)
        <a href="{{ $screenshot['full'] }}">
          <img class="screenshot" src="{{ $screenshot['thumb'] }}">
        </a>
      @endforeach
    </p>
  </section>
@endif

@if (sizeof($software) > 1 || !empty($developer_site))
  <section>
    <h2 class="mt-0">{{ trans('dcpp.links') }}</h2>
    <div class="row">
      @if (sizeof($software) > 1)
        <div class="col-md-4">
          <h4>{{ trans('dcpp.earlier_versions') }}</h4>
          <ul>
            @foreach ($software as $i => $soft)
              @continue ($i === 0)
              <li><a class="link" href="{{ action('Files@download', $soft['id']) }}">{{ trans('dcpp.download') }} {{ $software_title }} {{ $soft['version'] }}{{ $soft['dl_suffix'] }}</a></li>
            @endforeach
          </ul>
        </div>
      @endif
      @if (!empty($developer_site))
        <div class="col-md-4">
          <h4>{{ trans('dcpp.pages') }}</h4>
          <ul>
            <li><a class="link" href="{{ $developer_site }}">{{ trans('dcpp.developer_site') }}</a></li>
          </ul>
        </div>
      @endif
    </div>
  </section>
@endif

@if (App::environment('production'))
  <div class="mt-3 google-b-horizontal">
    <ins class="adsbygoogle d-block"
         data-ad-client="ca-pub-7802683087624570"
         data-ad-slot="1858304644"
         data-ad-format="auto"></ins>
    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
  </div>
@elseif (App::environment('local'))
  <div class="mt-3 banner-local google-b-horizontal"></div>
@endif
@endsection

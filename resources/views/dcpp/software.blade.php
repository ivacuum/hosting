@extends('dcpp.base', [
  'no_footer_banner' => true,
  'content_container_classes' => '',
])

@section('content')
<div class="life-text">
  <section class="tw-my-0 tw-pt-6">
    <div class="tw-container">
      <h1 class="tw-mb-6">{{ trans('dcpp.download') }} {{ $software_title }} {{ $software[0]['version'] }}</h1>
      @section('download_latest')
        <div>
          <a class="btn btn-success tw-my-1 btn-lg" href="{{ path('Files@download', $software[0]['id']) }}">
            @php ($icon = $software[0]['icon'] ?? 'windows')
            <span class="tw-mr-1">
              @svg ($icon)
            </span>
            {{ trans('dcpp.download') }}{{ $software[0]['dl_suffix'] }}
            @if (!empty($software[0]['size']))
              &middot;
              {{ ViewHelper::size($software[0]['size']) }}
            @endif
          </a>
        </div>
      @show
    </div>
  </section>

  <section class="tw-my-0 tw-py-12">
    <div class="tw-container">
      <h2>{{ trans('dcpp.about_software') }}</h2>
      @yield('about_software')
    </div>
  </section>

  <div class="tw-mb-4">
    <div class="tw-container">
      <div class="tw-mobile-wide">
        @include('tpl.google-horizontal')
      </div>
    </div>
  </div>

  @if (!empty($software_screenshots))
    <section class="bg-dark tw-my-0 tw-py-12 tw-text-gray-200">
      <div class="tw-container">
        <h2 class="tw-mb-6">{{ trans('dcpp.screenshots') }}</h2>
        <p>
          @foreach ($software_screenshots as $screenshot)
            <a href="{{ $screenshot['full'] }}">
              <img class="screenshot" src="{{ $screenshot['thumb'] }}">
            </a>
          @endforeach
        </p>
      </div>
    </section>
  @endif

  <section class="bg-light border-top border-bottom tw-my-0 tw-py-12">
    <div class="tw-container">
      <h2>{{ trans('dcpp.hubs') }}</h2>
      @ru
        <p>Ищите куда подключиться для обмена файлами? Ознакомьтесь с нашими рекомендациями.</p>
      @en
        <p>Looking for a place to connect to download and share files?</p>
      @endru
      <p>
        <a class="btn btn-important" href="{{ path('DcppHubs@index') }}">
          @ru
            Список популярных DC++ хабов
          @en
            List of popular DC++ hubs
          @endru
        </a>
      </p>
    </div>
  </section>

  @yield('software_features')

  @if (sizeof($software) > 1 || !empty($developer_site))
    <section class="border-bottom tw-my-0 tw-py-12">
      <div class="tw-container">
        <h2 class="tw-mb-6">{{ trans('dcpp.links') }}</h2>
        <div class="row">
          @if (sizeof($software) > 1)
            <div class="col-md-6 col-lg-5 col-xl-4">
              <h4>{{ trans('dcpp.earlier_versions') }}</h4>
              <ul>
                @foreach ($software as $soft)
                  @continue ($loop->index === 0)
                  <li><a class="link" href="{{ path('Files@download', $soft['id']) }}">{{ trans('dcpp.download') }} {{ $software_title }} {{ $soft['version'] }}{{ $soft['dl_suffix'] }}</a></li>
                @endforeach
              </ul>
            </div>
          @endif
          @if (!empty($developer_site))
            <div class="col-md-6 col-lg-5 col-xl-4">
              <h4>{{ trans('dcpp.pages') }}</h4>
              <ul>
                <li>
                  <a class="link" href="{{ $developer_site }}">{{ trans('dcpp.developer_site') }}</a>
                  <span class="text-muted">
                    @svg (external-link)
                  </span>
                </li>
              </ul>
            </div>
          @endif
        </div>
      </div>
    </section>
  @endif

  <section class="bg-light tw-my-0 tw-py-12">
    <div class="tw-container">
      <div class="row">
        <div class="col-md-6">
          <div class="h3">{{ trans('issues.create') }}</div>
          @ru
            <p>Поделитесь своими знаниями или задайте вопрос. Мы постараемся обработать информацию и дополнить эту страницу новыми материалами.</p>
          @en
            <p>Use the form below to ask a question or just to tell us how to make this page better.</p>
          @endru
          <feedback-form
            email="{{ Auth::user()->email ?? '' }}"
            title="DC++ Client"
            action="{{ path('Issues@store') }}"
            hide-title
          ></feedback-form>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3 tw-mt-4 md:tw-mt-0">
          @include('tpl.google-vertical')
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

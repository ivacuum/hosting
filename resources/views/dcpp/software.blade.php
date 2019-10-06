@extends('dcpp.base', [
  'noFooterBanner' => true,
  'contentContainerClasses' => '',
])

@section('content')
<div class="antialiased hanging-puntuation-first lg:text-lg">
  <section class="my-0 pt-6">
    <div class="container">
      <h1 class="mb-6">{{ trans('dcpp.download') }} {{ $softwareTitle }} {{ $software[0]['version'] }}</h1>
      @section('download_latest')
        <div>
          <a class="btn btn-success my-1 text-lg px-4 py-2" href="{{ path('Files@download', $software[0]['id']) }}">
            <?php $icon = $software[0]['icon'] ?? 'windows' ?>
            <span class="mr-1">
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

  <section class="my-0 py-12">
    <div class="container">
      <h2>{{ trans('dcpp.about_software') }}</h2>
      @yield('about_software')
    </div>
  </section>

  <div class="mb-4">
    <div class="container">
      <div class="mobile-wide">
        @include('tpl.google-horizontal')
      </div>
    </div>
  </div>

  @if (!empty($softwareScreenshots))
    <section class="bg-gray-800 my-0 py-12 text-gray-200">
      <div class="container">
        <h2 class="mb-6">{{ trans('dcpp.screenshots') }}</h2>
        <p>
          @foreach ($softwareScreenshots as $screenshot)
            <a href="{{ $screenshot['full'] }}">
              <img class="inline-block screenshot" src="{{ $screenshot['thumb'] }}" alt="">
            </a>
          @endforeach
        </p>
      </div>
    </section>
  @endif

  <section class="bg-light border-t border-b border-gray-200 my-0 py-12">
    <div class="container">
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

  @if (sizeof($software) > 1 || !empty($developerSite))
    <section class="border-b border-gray-200 my-0 py-12">
      <div class="container">
        <h2 class="mb-6">{{ trans('dcpp.links') }}</h2>
        <div class="md:flex md:-mx-4">
          @if (sizeof($software) > 1)
            <div class="md:w-1/2 lg:w-5/12 xl:w-1/3 md:px-4">
              <h4>{{ trans('dcpp.earlier_versions') }}</h4>
              <ul>
                @foreach ($software as $soft)
                  @continue ($loop->index === 0)
                  <li><a class="link" href="{{ path('Files@download', $soft['id']) }}">{{ trans('dcpp.download') }} {{ $softwareTitle }} {{ $soft['version'] }}{{ $soft['dl_suffix'] }}</a></li>
                @endforeach
              </ul>
            </div>
          @endif
          @if (!empty($developerSite))
            <div class="md:w-1/2 lg:w-5/12 xl:w-1/3 md:px-4">
              <h4>{{ trans('dcpp.pages') }}</h4>
              <ul>
                <li>
                  <a class="link" href="{{ $developerSite }}">{{ trans('dcpp.developer_site') }}</a>
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

  <section class="bg-light my-0 py-12">
    <div class="container">
      <div class="md:flex md:-mx-4">
        <div class="md:w-1/2 md:px-4">
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
        <div class="md:w-1/2 lg:w-1/3 xl:w-1/4 md:px-4 mt-4 md:mt-0">
          @include('tpl.google-vertical')
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

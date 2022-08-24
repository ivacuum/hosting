@extends('dcpp.base', [
  'noFooterBanner' => true,
  'contentContainerClasses' => '',
])
@include('livewire')

@section('content')
<div class="antialiased hanging-punctuation-first lg:text-lg">
  <section class="my-0 pt-6">
    <div class="container">
      <h1 class="mb-6">@lang('Скачать') {{ $softwareTitle }} {{ $software[0]['version'] }}</h1>
      @section('download_latest')
        <div>
          <a class="btn btn-success my-1 text-lg px-4 py-2" href="{{ path([App\Http\Controllers\Files::class, 'download'], $software[0]['id']) }}">
            <?php $icon = $software[0]['icon'] ?? 'windows' ?>
            <span class="mr-1">
              @svg ($icon)
            </span>
            @lang('Скачать'){{ $software[0]['dl_suffix'] }}
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
      <h2 class="tracking-tight">@lang('dcpp.about_software')</h2>
      @yield('about_software')
    </div>
  </section>

  <div class="mb-4">
    <div class="container">
      <div class="-mx-4 sm:mx-0">
        @include('tpl.google-horizontal')
      </div>
    </div>
  </div>

  @if (!empty($softwareScreenshots))
    <section class="bg-gray-700 my-0 py-12 text-grey-200">
      <div class="container">
        <h2 class="tracking-tight mb-6">@lang('Скриншоты')</h2>
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

  <section class="bg-light dark:bg-slate-800 border-t border-b border-grey-200 dark:border-slate-700 my-0 py-12">
    <div class="container">
      <h2 class="tracking-tight">@lang('Хабы')</h2>
      @ru
        <p>Ищете куда подключиться для обмена файлами? Ознакомьтесь с нашими рекомендациями.</p>
      @en
        <p>Looking for a place to connect to download and share files?</p>
      @endru
      <p>
        <a class="btn border border-transparent bg-orange-400 text-white hover:bg-orange-500 hover:text-white" href="@lng/dc/hubs">
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

  @if (count($software) > 1 || !empty($developerSite))
    <section class="border-b border-grey-200 dark:border-slate-700 my-0 py-12">
      <div class="container">
        <h2 class="tracking-tight mb-6">@lang('dcpp.links')</h2>
        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">
          @if (count($software) > 1)
            <div>
              <h4 class="font-medium text-xl mb-1">@lang('dcpp.earlier_versions')</h4>
              <ul>
                @foreach ($software as $soft)
                  @continue ($loop->index === 0)
                  <li><a class="link" href="{{ path([App\Http\Controllers\Files::class, 'download'], $soft['id']) }}">@lang('Скачать') {{ $softwareTitle }} {{ $soft['version'] }}{{ $soft['dl_suffix'] }}</a></li>
                @endforeach
              </ul>
            </div>
          @endif
          @if (!empty($developerSite))
            <div>
              <h4 class="font-medium text-xl mb-1">@lang('dcpp.pages')</h4>
              <ul>
                <li>
                  <a class="link" href="{{ $developerSite }}">@lang('dcpp.developer_site')</a>
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

  <section class="bg-light dark:bg-slate-800 my-0 py-12">
    <div class="container">
      <div class="grid md:grid-cols-2 gap-8">
        <div>
          <div class="h3">@lang('Обратная связь')</div>
          @ru
            <p>Поделитесь своими знаниями или задайте вопрос. Мы постараемся обработать информацию и дополнить эту страницу новыми материалами.</p>
          @en
            <p>Use the form below to ask a question or just to tell us how to make this page better.</p>
          @endru
          @livewire(App\Http\Livewire\FeedbackForm::class, [
            'title' => 'DC++ Client',
            'hideTitle' => true,
          ])
        </div>
        <div class="lg:w-2/3 xl:w-1/2">
          @include('tpl.google-vertical')
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

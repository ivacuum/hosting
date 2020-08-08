<nav class="flex flex-wrap text-sm lowercase mb-4">
  <div class="mr-3 whitespace-no-wrap">
    @if ($routeUri === 'life')
      <mark>@lang('По годам')</mark>
    @else
      <a class="link" href="{{ path([App\Http\Controllers\Life::class, 'index']) }}">@lang('По годам')</a>
    @endif
  </div>
  <div class="mr-3 whitespace-no-wrap">
    @if ($routeUri === 'life/countries')
      <mark>@lang('По странам')</mark>
    @else
      <a class="link" href="{{ path([App\Http\Controllers\Life::class, 'countries']) }}">@lang('По странам')</a>
    @endif
  </div>
  <div class="mr-3 whitespace-no-wrap">
    @if ($routeUri === 'life/cities')
      <mark>@lang('По городам')</mark>
    @else
      <a class="link" href="{{ path([App\Http\Controllers\Life::class, 'cities']) }}">@lang('По городам')</a>
    @endif
  </div>
  <div class="whitespace-no-wrap">
    @if ($routeUri === 'life/calendar')
      <mark>@lang('Календарь')</mark>
    @else
      <a class="link" href="{{ path(App\Http\Controllers\Calendar::class) }}">@lang('Календарь')</a>
    @endif
  </div>
</nav>

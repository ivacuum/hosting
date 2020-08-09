<?php /** @var App\User $traveler */ ?>

<nav class="flex flex-wrap text-sm lowercase mb-4">
  <div class="mr-3 whitespace-no-wrap">
    @if ($routeUri === '@{login}/travel')
      <mark>@lang('По годам')</mark>
    @else
      <a class="link" href="{{ to('@{login}/travel', $traveler->login) }}">@lang('По годам')</a>
    @endif
  </div>
  <div class="mr-3 whitespace-no-wrap">
    @if ($routeUri === '@{login}/travel/countries')
      <mark>@lang('По странам')</mark>
    @else
      <a class="link" href="{{ to('@{login}/travel/countries', $traveler->login) }}">@lang('По странам')</a>
    @endif
  </div>
  <div class="mr-3 whitespace-no-wrap">
    @if ($routeUri === '@{login}/travel/cities')
      <mark>@lang('По городам')</mark>
    @else
      <a class="link" href="{{ to('@{login}/travel/cities', $traveler->login) }}">@lang('По городам')</a>
    @endif
  </div>
</nav>

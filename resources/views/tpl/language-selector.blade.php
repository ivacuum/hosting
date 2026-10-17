@foreach ($links as $languageLink)
  @if ($languageLink['locale'] !== $locale)
    <a
      class="flex flex-wrap gap-1 items-center whitespace-nowrap {{ $linkClasses ?? '' }} {{ match ($languageLink['locale']) { 'en' => 'js-english', 'ru' => 'js-russian', default => '' } }}"
      href="{{ $languageLink['href'] }}"
      lang="{{ $languageLink['locale'] }}"
    >
      @if ($languageLink['locale'] === 'en')
        <span>@svg (flag/en)</span>
      @elseif ($languageLink['locale'] === 'ru')
        <span>@svg (flag/ru)</span>
      @endif
      <span>{{ $languageLink['label'] }}</span>
    </a>
  @endif
@endforeach

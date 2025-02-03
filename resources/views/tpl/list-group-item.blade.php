<a class="border-l-2 px-3 py-2 {{ $classes ?? '' }} {{ ($isActive ?? false) ? 'border-amber-600 text-black dark:text-slate-200 hover:text-black dark:hover:text-slate-200' : 'border-transparent' }}" href="{{ $href ?? '#' }}">
  {{ $slot }}
</a>

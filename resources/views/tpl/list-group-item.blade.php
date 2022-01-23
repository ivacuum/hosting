<a class="border-l-2 border-transparent px-3 py-2 {{ $classes ?? '' }} {{ ($isActive ?? false) ? 'border-orangeish-600 text-black dark:text-slate-200 hover:text-black hover:dark:text-slate-200' : '' }}" href="{{ $href ?? '#' }}">
  {{ $slot }}
</a>

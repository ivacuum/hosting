<a class="border-l-2 border-transparent px-3 py-2 {{ $classes ?? '' }} {{ ($isActive ?? false) ? 'border-orange-600 text-black hover:text-black' : '' }}" href="{{ $href ?? '#' }}">
  {{ $slot }}
</a>

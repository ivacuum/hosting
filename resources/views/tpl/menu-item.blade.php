<a class="md:border-b-2 md:border-transparent px-0 md:px-2 py-2 md:py-3 text-grey-600 hover:text-grey-900 {{ ($isActive ?? false) ? 'md:border-blueish-600 text-grey-900' : '' }}" href="{{ $href ?? '#' }}">
  {{ $slot }}
</a>

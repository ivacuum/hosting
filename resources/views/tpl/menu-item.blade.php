<a class="md:border-b-2 md:border-transparent md:-mb-2px px-0 md:px-2 py-3 md:py-4 text-grey-600 hover:text-grey-900 {{ ($isActive ?? false) ? 'md:border-blueish-500 text-grey-900' : '' }}" href="{{ $href ?? '#' }}">
  {{ $slot }}
</a>

<a class="md:border-b-2 md:border-transparent md:-mb-2px px-0 md:px-2 py-3 md:py-4 text-gray-600 hover:text-gray-900 {{ ($isActive ?? false) ? 'md:border-blue-500 text-gray-900' : '' }}" href="{{ $href ?? '#' }}">
  {{ $slot }}
</a>

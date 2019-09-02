<a class="block border-b-2 border-transparent -mb-2px px-2 py-3 text-gray-600 hover:text-gray-900 {{ ($isActive ?? false) ? 'border-blue-500 text-gray-900' : '' }}" href="{{ $href ?? '#' }}">
  {{ $slot }}
</a>

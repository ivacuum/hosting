<div class="dropdown dropdown-hover">
  <a
    class="block md:border-b-2 md:border-transparent md:-mb-2px px-0 md:px-2 py-3 md:py-4 text-gray-600 hover:text-gray-900 outline-none dropdown-toggle {{ ($isActive ?? false) ? 'md:border-blue-500 text-gray-900' : '' }}"
    href="#"
    data-toggle="dropdown"
  >{{ $title }}</a>
  <div class="dropdown-menu leading-normal">
    {{ $slot }}
  </div>
</div>

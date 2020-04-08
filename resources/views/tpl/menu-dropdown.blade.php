<div class="dropdown dropdown-hover">
  <a
    class="block md:border-b-2 md:border-transparent md:-mb-2px px-0 md:px-2 py-3 md:py-4 text-grey-600 hover:text-grey-900 outline-none dropdown-toggle {{ ($isActive ?? false) ? 'md:border-blueish-500 text-grey-900' : '' }}"
    href="#"
    data-toggle="dropdown"
  >{{ $title }}</a>
  <div class="dropdown-menu leading-normal">
    {{ $slot }}
  </div>
</div>

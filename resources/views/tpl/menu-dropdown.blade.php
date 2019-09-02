<div class="dropdown dropdown-hover">
  <a
    class="block border-b-2 border-transparent -mb-2px px-2 py-3 text-gray-600 hover:text-gray-900 dropdown-toggle {{ ($isActive ?? false) ? 'border-blue-500 text-gray-900' : '' }}"
    href="#"
    data-toggle="dropdown"
  >{{ $title }}</a>
  <div class="dropdown-menu">
    {{ $slot }}
  </div>
</div>

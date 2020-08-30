<details class="relative details-reset details-overlay">
  <summary
    class="block md:border-b-2 md:border-transparent px-0 md:px-2 py-3 flex text-grey-600 hover:text-grey-900 {{ ($isActive ?? false) ? 'md:border-blueish-600 text-grey-900' : '' }}"
  >
    <div class="flex items-center">
      {{ $title }}
      @svg (angle-down)
    </div>
  </summary>
  <details-menu
    role="menu"
    class="absolute top-full left-0 z-50 py-2 bg-white mt-1 border border-gray-300 rounded shadow-md"
    style="min-width: 10rem;"
  >
    {{ $slot }}
  </details-menu>
</details>

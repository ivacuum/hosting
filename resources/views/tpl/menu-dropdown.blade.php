<details class="relative details-reset details-overlay">
  <summary
    class="flex md:border-b-2 md:border-transparent px-0 md:px-2 py-3 hover:text-grey-900 hover:dark:text-slate-200 {{ ($isActive ?? false) ? 'md:border-blueish-600 text-grey-900 dark:text-slate-200' : 'text-grey-600 dark:text-slate-400' }}"
  >
    <span class="flex items-center">
      {{ $title }}
      @svg (angle-down)
    </span>
  </summary>
  <details-menu
    role="menu"
    class="absolute top-full left-0 z-50 py-2 bg-white dark:bg-slate-800 mt-1 border border-gray-300 dark:border-slate-700 rounded shadow-md min-w-[10rem]"
  >
    {{ $slot }}
  </details-menu>
</details>

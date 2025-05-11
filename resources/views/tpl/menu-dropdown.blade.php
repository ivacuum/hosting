<details class="relative details-reset details-overlay">
  <summary
    class="flex md:border-b-2 px-0 md:px-2 py-3 hover:text-gray-900 dark:hover:text-slate-200 {{ ($isActive ?? false) ? 'md:border-sky-600 text-gray-900 dark:text-slate-200' : 'md:border-transparent text-gray-600 dark:text-slate-400' }}"
  >
    <span class="flex items-center">
      {{ $title }}
      @svg (angle-down)
    </span>
  </summary>
  <details-menu
    role="menu"
    class="absolute top-full left-0 z-50 py-2 bg-white dark:bg-slate-800 mt-1 border border-gray-300 dark:border-slate-700 rounded-sm shadow-md min-w-40"
  >
    {{ $slot }}
  </details-menu>
</details>

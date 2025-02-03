<a class="font-medium md:border-b-2 px-0 md:px-2 py-2 md:py-3 hover:text-gray-900 dark:hover:text-slate-200 {{ ($isActive ?? false) ? 'md:border-sky-600 text-gray-800 dark:text-slate-200' : 'md:border-transparent text-slate-600/75 dark:text-slate-400' }}" href="{{ $href ?? '#' }}">
  {{ $slot }}
</a>

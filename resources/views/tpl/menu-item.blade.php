<a class="md:border-b-2 md:border-transparent px-0 md:px-2 py-2 md:py-3 hover:text-grey-900 hover:dark:text-slate-200 {{ ($isActive ?? false) ? 'md:border-blueish-600 text-grey-900 dark:text-slate-200' : 'text-grey-600 dark:text-slate-400' }}" href="{{ $href ?? '#' }}">
  {{ $slot }}
</a>

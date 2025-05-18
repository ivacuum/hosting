<li class="hover:text-gray-950 dark:hover:text-white has-aria-[current=location]:border-gray-950">
  <a class="{{ ($level ?? 0) ? 'pl-' . (($level - 1) * 4) : '' }} block text-balance aria-[current=location]:font-medium aria-[current=location]:text-gray-950 dark:aria-[current=location]:text-white" href="#{{ $href ?? '' }}">{{ $slot }}</a>
</li>

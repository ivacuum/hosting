<li class="-ml-px flex border-l border-transparent pl-4 hover:text-gray-950 hover:not-has-aria-[current=page]:border-gray-400 dark:hover:text-white has-aria-[current=page]:border-gray-950 dark:has-aria-[current=page]:border-white">
  <a
    class="aria-[current=page]:text-gray-950 dark:aria-[current=page]:text-white"
    href="{{ $href }}"
    aria-current="{{ Str::of($routeUri)->is(trim($href, "/")) ? 'page' : 'false' }}"
  >{{ $slot }}</a>
</li>

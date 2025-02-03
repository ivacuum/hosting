<a {{ $attributes->merge(['class' => 'flex text-grey-900 dark:text-slate-400 px-6 py-1 whitespace-nowrap w-full hover:bg-grey-100 dark:hover:bg-slate-700 hover:text-grey-900 dark:hover:text-slate-200'])->except('href') }} href="{{ $absHref ?? to(ltrim($href, '/')) }}" role="menuitem">{{ $slot }}</a>

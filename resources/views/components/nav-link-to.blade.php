<a {{ $attributes->merge(['class' => 'mr-4 last:mr-0 py-2 border-b-2 border-transparent hover:border-gray-400' . ($isActive ?? false ? ' cursor-default text-black border-blueish-600 hover:text-black hover:border-blueish-600' : '')])->except('is-active') }}>{{ $slot }}</a>

<div class="-mt-2 mb-6 -mx-4 sm:mx-0 js-shortcuts-item" id="{{ $pic }}">
  <div class="max-w-full aspect-16/9 mx-auto text-center">
    <div class="relative">
      <img
        class="object-cover sm:rounded-sm"
        src="{{ ViewHelper::pic2x($slug, $pic) }}"
        alt=""
        loading="lazy"
      >
      <div class="absolute top-0 right-0">
        <a
          class="flex items-center justify-center p-2 text-white hover:text-gray-200 drop-shadow-xs/90 hover:drop-shadow-sm/90"
          href="{{ ViewHelper::pic2x($slug, $pic) }}"
        >
          @svg (link)
        </a>
      </div>
      <div class="absolute bottom-0 right-0 flex">
        <span class="rounded-xs text-white/10 hover:text-white hover:bg-black text-xs tracking-tighter px-0.5">{{ $pic }}</span>
      </div>
    </div>
  </div>
</div>

@if (App::isProduction())
  <div class="overflow-hidden h-90px mobile-wide">
    <ins
      class="adsbygoogle block"
      data-ad-client="ca-pub-7802683087624570"
      data-ad-slot="1858304644"
      data-ad-format="auto"
    ></ins>
    <script>(adsbygoogle = window.adsbygoogle || []).push({})</script>
  </div>
@elseif (App::isLocal())
  <div class="overflow-hidden w-full h-90px bg-teal-500 text-white flex justify-center items-center sm:rounded">google-horizontal</div>
@endif

@if (App::isProduction())
  <ins
    class="adsbygoogle block -mx-4 sm:mx-0"
    data-ad-client="ca-pub-7802683087624570"
    data-ad-slot="3039258747"
    data-ad-format="auto"
    data-full-width-responsive="true"
  ></ins>
  <script>(adsbygoogle = window.adsbygoogle || []).push({})</script>
@elseif (App::isLocal())
  <div class="bg-teal-500 text-white flex justify-center items-center py-12 rounded-sm">google-vertical</div>
@endif

@if (App::environment() === 'production')
  <ins
    class="adsbygoogle tw-block"
    data-ad-client="ca-pub-7802683087624570"
    data-ad-slot="3039258747"
    data-ad-format="auto"
    data-full-width-responsive="true"
  ></ins>
  <script>(adsbygoogle = window.adsbygoogle || []).push({})</script>
@elseif (App::isLocal())
  <div class="bg-info tw-text-white tw-flex tw-justify-center tw-items-center tw-h-full">google-vertical</div>
@endif

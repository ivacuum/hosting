@if (App::environment() === 'production')
  <ins
    class="adsbygoogle d-block"
    data-ad-client="ca-pub-7802683087624570"
    data-ad-slot="3039258747"
    data-ad-format="auto"
    data-full-width-responsive="true"
  ></ins>
  <script>(adsbygoogle = window.adsbygoogle || []).push({})</script>
@elseif (App::isLocal())
  <div class="bg-info text-white d-flex justify-content-center tw-items-center" style="height: 100%;">google-vertical</div>
@endif

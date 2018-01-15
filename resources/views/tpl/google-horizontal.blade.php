@if (App::environment() === 'production')
  <div class="google-b-horizontal">
    <ins class="adsbygoogle d-block"
         data-ad-client="ca-pub-7802683087624570"
         data-ad-slot="1858304644"
         data-ad-format="auto"></ins>
    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
  </div>
@elseif (App::isLocal())
  <div class="google-b-horizontal bg-info text-white d-flex justify-content-center align-items-center">google-horizontal</div>
@endif

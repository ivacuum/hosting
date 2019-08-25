@if (App::environment() === 'production')
  <div class="tw-overflow-hidden tw-h-90px tw-mobile-wide">
    <ins
      class="adsbygoogle tw-block"
      data-ad-client="ca-pub-7802683087624570"
      data-ad-slot="1858304644"
      data-ad-format="auto"
    ></ins>
    <script>(adsbygoogle = window.adsbygoogle || []).push({})</script>
  </div>
@elseif (App::isLocal())
  <div class="tw-overflow-hidden tw-w-full tw-h-90px tw-bg-teal-600 tw-text-white tw-flex tw-justify-center tw-items-center sm:tw-rounded">google-horizontal</div>
@endif

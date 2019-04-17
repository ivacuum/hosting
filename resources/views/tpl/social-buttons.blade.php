<div class="d-flex flex-wrap flex-sm-nowrap mobile-wide {{ $class ?? '' }}">
  <a
    class="btn bg-telegram f20 flex-grow-1 py-1 rounded-0 text-white w-50 w-sm-auto"
    href="https://t.me/share/url?url={{ rawurlencode($url) }}"
    rel="nofollow"
    title="Telegram"
    target="_blank"
  >
    @svg (telegram)
  </a>
  <a
    class="btn bg-vk f20 flex-grow-1 py-1 rounded-0 text-white w-50 w-sm-auto"
    href="https://vk.com/share.php?url={{ rawurlencode($url) }}&title={{ rawurlencode($title) }}&utm_source=share_button"
    rel="nofollow"
    title="VK"
    target="_blank"
  >
    @svg (vk)
  </a>
  <a
    class="btn bg-facebook f20 flex-grow-1 py-1 rounded-0 text-white w-50 w-sm-auto"
    href="https://www.facebook.com/sharer.php?u={{ rawurlencode($url) }}&utm_source=share_button"
    rel="nofollow"
    title="Facebook"
    target="_blank"
  >
    @svg (facebook)
  </a>
  <a
    class="btn bg-twitter f20 flex-grow-1 py-1 rounded-0 text-white w-50 w-sm-auto"
    href="https://twitter.com/intent/tweet?text={{ rawurlencode($title) }}&url={{ rawurlencode($url) }}&hashtags=&utm_source=share_button"
    rel="nofollow"
    title="Twitter"
    target="_blank"
  >
    @svg (twitter)
  </a>
  {{--
  <a
    class="btn bg-google f20 flex-grow-1 py-1 rounded-0 text-white w-50 w-sm-auto"
    href="https://plus.google.com/share?url={{ rawurlencode($url) }}&utm_source=share_button"
    rel="nofollow"
    title="Google"
    target="_blank"
  >
    @svg (google)
  </a>
  --}}
  <a
    class="btn bg-odnoklassniki f20 flex-grow-1 py-1 rounded-0 text-white w-50 w-sm-auto"
    href="https://connect.ok.ru/offer?url={{ rawurlencode($url) }}&title={{ rawurlencode($title) }}&utm_source=share_button"
    rel="nofollow"
    title="OK"
    target="_blank"
  >
    @svg (odnoklassniki)
  </a>
  @if ($is_mobile)
    <a
      class="btn bg-whatsapp f20 flex-grow-1 py-1 rounded-0 text-white w-50 w-sm-auto"
      href="whatsapp://send?text={{ rawurlencode($url) }}"
      rel="nofollow"
      title="WhatsApp"
      target="_blank"
    >
      @svg (whatsapp)
    </a>
    <a
      class="btn bg-viber f20 flex-grow-1 py-1 rounded-0 text-white w-50 w-sm-auto"
      href="viber://forward?text={{ rawurlencode($url) }}"
      rel="nofollow"
      title="Viber"
      target="_blank"
    >
      @svg (viber)
    </a>
  @endif
</div>

<div class="flex flex-wrap sm:flex-nowrap {{ $class ?? '' }}">
  <a
    class="btn bg-telegram-600 text-xl py-1 rounded-none text-white hover:bg-telegram-700 hover:text-white w-20"
    href="https://t.me/share/url?url={{ rawurlencode($url) }}"
    rel="nofollow"
    title="Telegram"
    target="_blank"
  >
    @svg (telegram)
  </a>
  <a
    class="btn bg-vk-600 text-xl py-1 rounded-none text-white hover:bg-vk-700 hover:text-white w-20"
    href="https://vk.com/share.php?url={{ rawurlencode($url) }}&title={{ rawurlencode($title) }}&utm_source=share_button"
    rel="nofollow"
    title="VK"
    target="_blank"
  >
    @svg (vk)
  </a>
  <a
    class="btn bg-facebook-600 text-xl py-1 rounded-none text-white hover:bg-facebook-700 hover:text-white w-20"
    href="https://www.facebook.com/sharer.php?u={{ rawurlencode($url) }}&utm_source=share_button"
    rel="nofollow"
    title="Facebook"
    target="_blank"
  >
    @svg (facebook)
  </a>
  <a
    class="btn bg-twitter-600 text-xl py-1 rounded-none text-white hover:bg-twitter-700 hover:text-white w-20"
    href="https://twitter.com/intent/tweet?text={{ rawurlencode($title) }}&url={{ rawurlencode($url) }}&hashtags=&utm_source=share_button"
    rel="nofollow"
    title="Twitter"
    target="_blank"
  >
    @svg (twitter)
  </a>
  {{--
  <a
    class="btn bg-google-600 text-xl py-1 rounded-none text-white hover:bg-google-700 hover:text-white w-20"
    href="https://plus.google.com/share?url={{ rawurlencode($url) }}&utm_source=share_button"
    rel="nofollow"
    title="Google"
    target="_blank"
  >
    @svg (google)
  </a>
  --}}
  <a
    class="btn bg-odnoklassniki-600 text-xl py-1 rounded-none text-white hover:bg-odnoklassniki-700 hover:text-white w-20"
    href="https://connect.ok.ru/offer?url={{ rawurlencode($url) }}&title={{ rawurlencode($title) }}&utm_source=share_button"
    rel="nofollow"
    title="OK"
    target="_blank"
  >
    @svg (odnoklassniki)
  </a>
  @if ($isMobile)
    <a
      class="btn bg-whatsapp-600 text-xl py-1 rounded-none text-white hover:bg-whatsapp-700 hover:text-white w-20"
      href="whatsapp://send?text={{ rawurlencode($url) }}"
      rel="nofollow"
      title="WhatsApp"
      target="_blank"
    >
      @svg (whatsapp)
    </a>
    <a
      class="btn bg-viber-600 text-xl py-1 rounded-none text-white hover:bg-viber-700 hover:text-white w-20"
      href="viber://forward?text={{ rawurlencode($url) }}"
      rel="nofollow"
      title="Viber"
      target="_blank"
    >
      @svg (viber)
    </a>
  @endif
</div>

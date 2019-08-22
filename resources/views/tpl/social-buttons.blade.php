<div class="tw-flex tw-flex-wrap sm:tw-flex-no-wrap {{ $class ?? '' }}">
  <a
    class="btn bg-telegram tw-text-xl tw-py-1 tw-rounded-none tw-text-white hover:tw-text-white tw-w-20"
    href="https://t.me/share/url?url={{ rawurlencode($url) }}"
    rel="nofollow"
    title="Telegram"
    target="_blank"
  >
    @svg (telegram)
  </a>
  <a
    class="btn bg-vk tw-text-xl tw-py-1 tw-rounded-none tw-text-white hover:tw-text-white tw-w-20"
    href="https://vk.com/share.php?url={{ rawurlencode($url) }}&title={{ rawurlencode($title) }}&utm_source=share_button"
    rel="nofollow"
    title="VK"
    target="_blank"
  >
    @svg (vk)
  </a>
  <a
    class="btn bg-facebook tw-text-xl tw-py-1 tw-rounded-none tw-text-white hover:tw-text-white tw-w-20"
    href="https://www.facebook.com/sharer.php?u={{ rawurlencode($url) }}&utm_source=share_button"
    rel="nofollow"
    title="Facebook"
    target="_blank"
  >
    @svg (facebook)
  </a>
  <a
    class="btn bg-twitter tw-text-xl tw-py-1 tw-rounded-none tw-text-white hover:tw-text-white tw-w-20"
    href="https://twitter.com/intent/tweet?text={{ rawurlencode($title) }}&url={{ rawurlencode($url) }}&hashtags=&utm_source=share_button"
    rel="nofollow"
    title="Twitter"
    target="_blank"
  >
    @svg (twitter)
  </a>
  {{--
  <a
    class="btn bg-google tw-text-xl tw-py-1 tw-rounded-none tw-text-white hover:tw-text-white tw-w-20"
    href="https://plus.google.com/share?url={{ rawurlencode($url) }}&utm_source=share_button"
    rel="nofollow"
    title="Google"
    target="_blank"
  >
    @svg (google)
  </a>
  --}}
  <a
    class="btn bg-odnoklassniki tw-text-xl tw-py-1 tw-rounded-none tw-text-white hover:tw-text-white tw-w-20"
    href="https://connect.ok.ru/offer?url={{ rawurlencode($url) }}&title={{ rawurlencode($title) }}&utm_source=share_button"
    rel="nofollow"
    title="OK"
    target="_blank"
  >
    @svg (odnoklassniki)
  </a>
  @if ($is_mobile)
    <a
      class="btn bg-whatsapp tw-text-xl tw-py-1 tw-rounded-none tw-text-white hover:tw-text-white tw-w-20"
      href="whatsapp://send?text={{ rawurlencode($url) }}"
      rel="nofollow"
      title="WhatsApp"
      target="_blank"
    >
      @svg (whatsapp)
    </a>
    <a
      class="btn bg-viber tw-text-xl tw-py-1 tw-rounded-none tw-text-white hover:tw-text-white tw-w-20"
      href="viber://forward?text={{ rawurlencode($url) }}"
      rel="nofollow"
      title="Viber"
      target="_blank"
    >
      @svg (viber)
    </a>
  @endif
</div>

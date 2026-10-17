@extends('base')

@section('content')
<div class="hanging-punctuation-first lg:text-lg">
  <h2 class="font-medium text-3xl mb-2">
    @ru
      О проекте
    @en
      About
    @endru
  </h2>

  @ru
    <p>Это личный сайт Сергея Панкова. Здесь я публикую заметки с фотографиями о поездках, концертах и играх. Еще делаю небольшие полезные инструменты для себя и других — например, тренажеры для практики иностранных языков.</p>
  @en
    <p>This is Sergei Pankov's personal website. I publish posts with photos about trips, concerts, and games. I also build small, useful tools for myself and others, such as trainers for practicing foreign languages.</p>
  @endru

  @ru
    <p>Сайт развивается с 2004 года. Сначала у него была самописная основа. В 2014 году был попробован фреймворк <a class="link" href="https://laravel.com/">Laravel</a> 4.2. Он успешно себя зарекомендовал, поэтому сайт до сих пор на нем — уже на версии Laravel {{ implode('.', array_slice(explode('.', App::version()), 0, 1)) }}.</p>
  @en
    <p>The site has been evolving since 2004. It originally ran on custom-built code. In 2014, I tried version 4.2 of the <a class="link" href="https://laravel.com/">Laravel</a> framework. It proved to be a good fit, so the site still runs on it — now on Laravel {{ implode('.', array_slice(explode('.', App::version()), 0, 1)) }}.</p>
  @endru

  @ru
    <p>Исходный код сайта доступен на <a class="link" href="https://github.com/ivacuum/hosting">GitHub</a>. После отправки изменений в основную ветку <a class="link" href="https://github.com/features/actions">GitHub Actions</a> собирает сайт, а <a class="link" href="https://docs.ansible.com/">Ansible</a> доставляет сборку на сервер с FreeBSD.</p>
  @en
    <p>The site's source code is available on <a class="link" href="https://github.com/ivacuum/hosting">GitHub</a>. Pushing changes to the main branch triggers a build in <a class="link" href="https://github.com/features/actions">GitHub Actions</a>, and <a class="link" href="https://docs.ansible.com/">Ansible</a> deploys the build to a FreeBSD server.</p>
  @endru

  @ru
    <p>Сайт бесплатный, поддерживаю его по мере сил. Гарантий доступности и поддержки нет.</p>
  @en
    <p>This site is a free, best-effort service and cannot provide any uptime or support guarantees.</p>
  @endru

  @ru
    <p>Я стараюсь, чтобы все работало, но иногда что-то идет не так: возникают проблемы с сетью или провайдером, нежелательный трафик замедляет ответы. Иногда я сам что-нибудь ломаю, хотя стараюсь этого не делать.</p>
  @en
    <p>I do my best to keep it running, but sometimes things go wrong. Sometimes there are network or provider issues outside of my control. Sometimes abusive traffic temporarily affects response times. Sometimes I break things by doing something wrong, but I try not to.</p>
  @endru

  <h2 class="font-medium text-3xl mt-12 mb-2">
    @ru
      Горячие клавиши
    @en
      Keyboard shortcuts
    @endru
  </h2>

  @ru
    <p>Вы можете использовать комбинации клавиш для ускорения пользования сайтом.</p>
  @en
    <p>You can use keyboard shortcuts to get things done faster on the site.</p>
  @endru

  <ul>
    @ru
      <li><x-kbd>/</x-kbd> — фокус на поле поиска, если оно есть на странице.</li>
    @en
      <li><x-kbd>/</x-kbd> — focus the search field, if the page has one.</li>
    @endru

    @ru
      <li><x-kbd>alt e</x-kbd> — переключиться на английский язык.</li>
    @en
      <li><x-kbd>alt e</x-kbd> — switch to English.</li>
    @endru

    @ru
      <li><x-kbd>alt r</x-kbd> — переключиться на русский язык.</li>
    @en
      <li><x-kbd>alt r</x-kbd> — switch to Russian.</li>
    @endru

    @ru
      <li><x-kbd>alt &larr;</x-kbd> или <x-kbd>ctrl &larr;</x-kbd> — перейти на предыдущую страницу.</li>
    @en
      <li><x-kbd>alt &larr;</x-kbd> or <x-kbd>ctrl &larr;</x-kbd> — go to the previous page.</li>
    @endru

    @ru
      <li><x-kbd>alt &rarr;</x-kbd> или <x-kbd>ctrl &rarr;</x-kbd> — перейти на следующую страницу.</li>
    @en
      <li><x-kbd>alt &rarr;</x-kbd> or <x-kbd>ctrl &rarr;</x-kbd> — go to the next page.</li>
    @endru

    @ru
      <li><x-kbd>j</x-kbd> и <x-kbd>k</x-kbd> — прокрутить к следующему или предыдущему абзацу или фотографии. На краю списка — перейти на соседнюю страницу.</li>
    @en
      <li><x-kbd>j</x-kbd> and <x-kbd>k</x-kbd> — scroll to the next or previous paragraph or photo. At the end or beginning of the list, move to the adjacent page.</li>
    @endru

    @ru
      <li><x-kbd>h</x-kbd> и <x-kbd>l</x-kbd> — прокрутить к первому или последнему абзацу или фотографии. Повторное нажатие — перейти на предыдущую / следующую страницу.</li>
    @en
      <li><x-kbd>h</x-kbd> and <x-kbd>l</x-kbd> — scroll to the first or last paragraph or photo. Press again to go to the previous / next page.</li>
    @endru

    @ru
      <li><x-kbd>ctrl enter</x-kbd> — сообщить об опечатке в выделенном тексте.</li>
    @en
      <li><x-kbd>ctrl enter</x-kbd> — report a typo in the selected text.</li>
    @endru
  </ul>

  <h2 class="font-medium text-3xl mt-12 mb-2" id="rss">
    @ru
      Подписка по RSS
    @en
      RSS subscriptions
    @endru
  </h2>

  @ru
    <p>Самый удобный способ получать новые <a class="link" href="{{ to('life/rss') }}">заметки</a>, <a class="link" href="{{ to('life/gigs/rss') }}">концерты</a> или <a class="link" href="{{ to('news/rss') }}">новости сайта</a> прямо в вашу RSS-читалку.</p>
  @en
    <p>The easiest way to get new <a class="link" href="{{ to('life/rss') }}">notes</a>, <a class="link" href="{{ to('life/gigs/rss') }}">concert posts</a>, or <a class="link" href="{{ to('news/rss') }}">site news</a> delivered straight to your RSS reader.</p>
  @endru

  <h2 class="font-medium text-3xl mt-12 mb-2" id="contact">
    @ru
      Связь и обратная связь
    @en
      Contact and feedback
    @endru
  </h2>

  @ru
    <p>Задать вопрос, сообщить о проблеме или предложить улучшение можно через <a class="link" href="{{ to('contact') }}">форму обратной связи</a>.</p>
  @en
    <p>Use the <a class="link" href="{{ to('contact') }}">feedback form</a> to ask a question, report a problem, or suggest an improvement.</p>
  @endru

  <h2 class="font-medium text-3xl mt-12 mb-2" id="photos">
    @ru
      Использование фотографий
    @en
      Photo reuse
    @endru
  </h2>

  @ru
    <p>Мои фотографии можно использовать с указанием ссылки на страницу этого сайта, с которой вы ее взяли.</p>
  @en
    <p>You may reuse my photos with a link to the page on this site where you found them.</p>
  @endru
</div>
@endsection

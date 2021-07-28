@extends('base')

@section('content')
<div class="antialiased hanging-puntuation-first lg:text-lg">
  @ru
    <h2>О проекте</h2>
    <p>Этот сайт — результат пробы фреймворка <a class="link" href="https://laravel.com/">Laravel</a>. Первое время в основе была версия 4.2, сейчас — {{ implode('.', array_slice(explode('.', App::version()), 0, 2)) }}.</p>

    <p>Код проекта расположен в хранилище <a class="link" href="https://github.com/ivacuum/hosting">GitHub</a>. После отправки изменений в репозиторий запускается сборка сайта сервисом интеграции <a class="link" href="https://jenkins.io/">Jenkins</a> с полученными обновлениями. После успешной сборки запускается новая версия сайта, при этом не происходит простоя в работе последнего.</p>

    <p>Работу <a href="/parser/vk" class="link">парсера ВК</a> обеспечивает библиотека <a href="https://guzzle.readthedocs.org/" class="link">Guzzle</a>. Также в том разделе доступны следующие горячие клавиши:</p>
    <ul>
      <li><x-kbd>j</x-kbd> — следующая запись</li>
      <li><x-kbd>k</x-kbd> — предыдущая запись</li>
      <li><x-kbd>h</x-kbd> — первая запись на странице</li>
      <li><x-kbd>l</x-kbd> — последняя запись на странице</li>
      <li><x-kbd>ctrl &rarr;</x-kbd> и <x-kbd>alt &rarr;</x-kbd> — следующая страница</li>
      <li><x-kbd>ctrl &larr;</x-kbd> и <x-kbd>alt &larr;</x-kbd> — предыдущая страница</li>
    </ul>
  @en
    <h2>About</h2>
    <p>This site is a free, best-effort service and cannot provide any uptime or support guarantees.</p>
    <p>I do my best to keep it running, but sometimes things go wrong. Sometimes there are network or provider issues outside of my control. Sometimes abusive traffic temporarily affects response times. Sometimes I break things by doing something wrong, but I try not to.</p>
  @endru
</div>
@endsection

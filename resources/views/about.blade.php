@extends('base')

@section('content')
<div class="life-text">
  @ru
    <h2 class="m-t-0">О проекте</h2>
    <p>Этот сайт — результат пробы фреймворка <a class="link" href="https://laravel.com/">Laravel</a>. Первое время в основе была версия 4.2, сейчас — {{ implode('.', array_slice(explode('.', App::version()), 0, 2)) }}.</p>

    <p>Код проекта расположен в хранилище <a class="link" href="https://github.com/ivacuum/hosting">GitHub</a>. После отправки изменений в репозиторий запускается сборка сайта сервисом интеграции <a class="link" href="https://jenkins.io/">Jenkins</a> с полученными обновлениями. После успешной сборки запускается новая версия сайта, при этом не происходит простоя в работе последнего.</p>

    <p>Работу <a href="/parser/vk" class="link">парсера ВК</a> обеспечивает библиотека <a href="http://guzzle.readthedocs.org/" class="link">Guzzle</a>. Также в том разделе доступны следующие горячие клавиши:</p>
    <ul>
      <li><kbd>j</kbd> — следующая запись</li>
      <li><kbd>k</kbd> — предыдущая запись</li>
      <li><kbd>h</kbd> — первая запись на странице</li>
      <li><kbd>l</kbd> — последняя запись на странице</li>
      <li><kbd>ctrl &rarr;</kbd> и <kbd>alt &rarr;</kbd> — следующая страница</li>
      <li><kbd>ctrl &larr;</kbd> и <kbd>alt &larr;</kbd> — предыдущая страница</li>
    </ul>

    <p>Наполнение и вывод <a class="link" href="/life">заметок</a> сильно упрощает <a class="link" href="http://fotorama.io/">фоторама</a>.</p>
  @en
    <h2 class="m-t-0">About</h2>
    <p>This site is a free, best-effort service and cannot provide any uptime or support guarantees.</p>
    <p>I do my best to keep it running, but sometimes things go wrong. Sometimes there are network or provider issues outside of my control. Sometimes abusive traffic temporarily affects response times. Sometimes I break things by doing something wrong, but I try not to.</p>
  @endlang
</div>
@endsection

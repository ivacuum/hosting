@extends('base')

@section('content')
<div class="lead">
  <h2 class="m-t-0">О проекте</h2>
  <p>Этот сайт — результат пробы фреймворка <a href="http://laravel.com/" class="link">Laravel</a>. Первое время в основе была версия 4.2, сейчас — 5.1.</p>

  <p>Код проекта расположен в хранилище <a href="https://bitbucket.org/" class="link">BitBucket</a>. Основным критерием выбора стали бесплатные закрытые репозитории. После отправки изменений в репозиторий запускается сборка сайта сервисом интеграции <a href="http://jenkins-ci.org" class="link">Jenkins</a> с полученными обновлениями. После успешной сборки запускается новая версия сайта, при этом не происходит простоя в работе последнего.</p>

  <p>Работу <a href="/parser/vk" class="link">парсера ВК</a> обеспечивает библиотека <a href="http://guzzle.readthedocs.org/" class="link">Guzzle</a>. Также в том разделе доступны следующие горячие клавиши:</p>
  <ul>
    <li><kbd>j</kbd> — следующая запись</li>
    <li><kbd>k</kbd> — предыдущая запись</li>
    <li><kbd>h</kbd> — первая запись на странице</li>
    <li><kbd>l</kbd> — последняя запись на странице</li>
    <li><kbd>ctrl &rarr;</kbd> и <kbd>alt &rarr;</kbd> — следующая страница</li>
    <li><kbd>ctrl &larr;</kbd> и <kbd>alt &larr;</kbd> — предыдущая страница</li>
  </ul>

  <p>Наполнение и вывод <a href="/life" class="link">заметок</a> сильно упрощает <a href="http://fotorama.io/" class="link">фоторама</a>. Остальные зависимости можно увидеть в файле <a href="/bower.json" class="link">bower.json</a>. Фотографии хранятся в <a href="http://aws.amazon.com/s3/" class="link">Amazon S3</a> в Ирландии и проксируются через сервер в Москве. Прокси помогает уменьшить объем платного трафика, Амазон же обеспечивает надежное хранение файлов.</p>
</div>
@endsection

@extends('life.base', [
  'meta_title' => 'Chillout',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Chillout'],
  ]
])

@section('content')
<h1 class="h2">Chillout</h1>
<p>Спокойная музыка для фона.</p>

<ul>
  <li>
    <a class="link" href="https://vk.com/audios-23004022">Chillout Breeze by M.SOUND</a>
    <span class="tw-text-sm text-muted">более 50 часовых сетов</span>
  </li>
</ul>
@endsection

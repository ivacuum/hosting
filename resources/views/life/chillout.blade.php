@extends('life.base', [
  'meta_title' => 'Chillout',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Chillout'],
  ]
])

@section('content')
<div class="h2">Chillout</div>
<p>Спокойная музыка для фона.</p>

<ul>
  <li>
    <a class="link" href="http://promodj.com/soundlabel/groups/379178/Chillout_Breeze_v_iTunes">Chillout Breeze by M.SOUND</a>
    <span class="text-muted">более 30 часовых сетов</span>
  </li>
</ul>
@endsection

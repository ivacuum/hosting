@extends('life.gigs.base', [
  'meta_title' => 'Oomph! в Москве &middot; 21 апреля 2007',
  'meta_description' => 'Заметки о концерте.',
  'meta_image' => 'https://life.ivacuum.ru/gigs/oomph.2007.04.21.jpg',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Концерты', 'url' => 'life/gigs'],
    ['title' => 'Oomph!']
  ]
])

@section('content')
<h2>Oomph! в Москве <small>21 апреля 2007</small></h2>
<div class="row">
  <div class="col-md-7">
    <p lang="ru">Первый посещенный концерт, между делом и первая самостоятельная поездка в Москву. Втроем с печатной картой отправились на поиски места проведения шоу. Уже на подходе к клубу впечатлило какая собирается аудитория — люди преимущественно в черном, с кучей цепей, которые охрана с них на входе снимала и кидала в коробку.</p>
    <p lang="ru">После концерта благополучно выбрались из зала и вспомнили, что забыли рюкзак с вещами. Предстояло вернуться, но охрана упорно не пускала, говоря, что шоу закончилось, и пора идти домой. Прошло около часа, нас все-таки пустили. Оказалось, что к этому времени музыканты вышли в зал пообщаться с людьми. Говорили со всеми желающими на английском и немецком.</p>
    <p lang="ru">Обратно предстояло идти пешком до Киевского вокзала. Навигатором выступала карта автомобильных дорог.</p>
    <p lang="ru">Что играли:</p>
    <ol>
      <li>Träumst Du</li>
      <li>Unsere Rettung</li>
      <li>Keine Luft mehr</li>
      <li>Du willst es doch auch</li>
      <li>Fieber</li>
      <li>Wenn Du weinst</li>
      <li>Die Schlinge</li>
      <li>Supernova</li>
      <li>Sex hat keine Macht</li>
      <li>Mitten ins Herz</li>
      <li>Das letzte Streichholz</li>
      <li>Dein Feuer</li>
      <li>Das weiße Licht</li>
      <li>Mein Schatz</li>
      <li>Dein Weg</li>
      <li>Gekreuzigt</li>
      <li>Niemand</li>
      <li>Augen auf!</li>
      <li>Brennende Liebe</li>
      <li>Gott ist ein Popstar</li>
      <li>Menschsein</li>
      <li>Strangers in the Night <small class="text-muted">(Frank Sinatra cover)</small></li>
      <li>Burn Your Eyes</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="//life.ivacuum.ru/gigs/oomph.2007.04.21.jpg">
    </div>
  </div>
</div>

<p lang="ru">Видеозапись выступления:</p>
<div class="fotorama" data-width="720" data-ratio="4/3">
  <a href="https://vk.com/video_ext.php?oid=169906990&id=166021194&hash=59db4e7dbf3f1ae4&hd=2" data-video="true">
    <img src="https://pp.vk.me/c13332/u145765/video/l_c222ad84.jpg">
  </a>
</div>

@include('life.timeline.oomph')
@endsection

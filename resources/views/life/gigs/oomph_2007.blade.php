@extends('life.gigs.base')

{{-- Клуб Тень --}}

@section('content')
@ru
  <p>Первый посещенный концерт, между делом и первая самостоятельная поездка в Москву. Втроем с печатной картой отправились на поиски места проведения шоу. Уже на подходе к клубу впечатлило какая собирается аудитория — люди преимущественно в черном, с кучей цепей, которые охрана с них на входе снимала и кидала в коробку.</p>
  <p>После концерта благополучно выбрались из зала и вспомнили, что забыли рюкзак с вещами. Предстояло вернуться, но охрана упорно не пускала, говоря, что шоу закончилось, и пора идти домой. Прошло около часа, нас все-таки пустили. Оказалось, что к этому времени музыканты вышли в зал пообщаться с людьми. Говорили со всеми желающими на английском и немецком.</p>
  <p>Обратно предстояло идти пешком до Киевского вокзала. Навигатором выступала карта автомобильных дорог.</p>
@endru

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/oomph.2007.04.21.jpg'])
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
    <li>Strangers in the Night <span class="text-sm text-muted">Frank Sinatra cover</span></li>
    <li>Burn Your Eyes</li>
  </ol>
@endcomponent

@ru
  <p>Видеозапись выступления: <a class="link" href="https://vk.com/video_ext.php?oid=169906990&id=166021194&hash=59db4e7dbf3f1ae4&hd=2">Смотреть на vk.com</a></p>
@endru
@endsection

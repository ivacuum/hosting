@extends('life.gigs.base')

@section('content')
@ru
  {{--
  <div class="mb-2">
    @include('tpl.gig-countdown', ['showDatetime' => '2019-07-29 19:00:00'])
  </div>
  --}}
  <p>Новый тур группы Раммштайн. Шестнадцатое выступление по счету в России. В этот раз концерт в поддержку нового студийного альбома под названием Rammstein, выпущенного 17 мая. Место проведения концерта: большая спортивная арена Лужники.</p>
  {{-- Смена стадиона --}}
  {{--
  <p>
    <a class="btn btn-primary" href="http://tci.ru/rammstein2019/">Купить билет</a>
    <a class="btn btn-default" href="https://vk.com/rammstein_2019_msk">Группа ВК</a>
  </p>
  --}}
@endru

@ru
  <p>Билет был куплен в день старта предпродаж — аж 5 ноября 2018 года. Цена была весьма доступной — менее ста евро. Без разделения на танцпол и фан-зону. В первые пару дней после начала общей продажи билеты на танцпол закончились.</p>
@endru

@ru
  <p>За день до концерта сцена уже была собрана. В небо из Лужников светили прожекторы, напоминая таковой с логотипом Бэтмена.</p>
@endru

@ru
  <p>Вход на стадион Лужники осуществляется самостоятельно через турникеты, которым можно показать код как с бумажной копии билета, так и с электронной. Выход по тому же коду. Так как туалет снаружи, то актуально входить и выходить несколько раз за вечер.</p>
@endru

@ru
  <p>Поздновато за два часа до начала приходить — половина стадиона уже заполнена. В середине танцпола ощущение, что пришел на дискотеку: свет есть, музыка есть, люди есть, а музыкантов не видно.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0103.jpg'])

@ru
  <p>Обстановка вокруг и ожидающие зрители.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0098.jpg',
  'IMG_0100.jpg',
  'IMG_0101.jpg',
]])

@ru
  <p>Трибуны заполняются.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0105.jpg'])

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/rammstein.2019.07.29.png'])
  <ol>
    <li>Was ich liebe</li>
    <li>Links 2-3-4</li>
    <li>Tattoo</li>
    <li>Sehnsucht</li>
    <li>Zeig dich</li>
    <li>Mein Herz brennt</li>
    <li>Puppe</li>
    <li>Heirate mich</li>
    <li>Diamant</li>
    <li>Deutschland (RMX by Richard Z. Kruspe)</li>
    <li>Deutschland</li>
    <li>Radio</li>
    <li>Mein Teil</li>
    <li>Du hast</li>
    <li>Sonne</li>
    <li>Ohne dich</li>
    <li>Engel</li>
    <li>Ausländer</li>
    <li>Du riechst so gut</li>
    <li>Pussy</li>
    <li>Rammstein</li>
    <li>Ich will</li>
  </ol>
@endcomponent

@ru
  <p>Шоу закончилось. Появилась возможность подойти поближе, но не прямо к сцене — впереди заградительный барьер примерно на три тысячи человек. Эдакая фан-зона для тех, кто очень рано пришел. По ощущениям и вычитанному, рано — это более чем за шесть часов до начала.</p>
@endru

@ru
  <p>Сомнительное решение не ставить большие экраны для зрителей. Тот вертикальный с титрами в самом верху сцены — это все, что было. И пользовались им от силы половину концерта. Весь тур по огромным стадионам, а большинству публики банально не видно группу на сцене.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0106.jpg'])

@ru
  <p>Конфетти продолжает развлекать и по окончании концерта.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0109.jpg',
  'IMG_0110.jpg',
]])

@ru
  <p>Весьма долго после такого массового концерта найтись с друзьями около стадиона. Толпы организованно ведут к общественному транспорту меняющимися маршрутами, поэтому один путь сейчас еще открыт, а через минуту уже перекрыт. Так и идете лабиринтами добрых полчаса к месту сбора.</p>
@endru

@ru
  <p>Видеозапись концерта.</p>
@en
  <p>Video of the show.</p>
@endru
<livewire:youtube title="Rammstein 2019, Luzhniki Stadium, Moscow, Russia" v="hYFAxa5lDMo"/>

<h3 class="mt-12">@ru Бонусные материалы @en Bonus materials @endru</h3>
<ul>
  <li><a class="link" href="https://www.instagram.com/p/B0jg1buAmi2/">@ru Видео из инстаграма Тилля @en Video from Till's Instagram @endru</a></li>
</ul>
@endsection

@extends('life.gigs.base')

{{-- Bowling Green --}}

@section('content')
@ru
  <p>Начал слушать Пинк Флойд только в конце нулевых, перед сложными экзаменами в университете. Через несколько лет пришла мысль, что неплохо было бы съездить на шоу группы, но оказалось, что их клавишника уже не было в живых, а вокалист и гитарист Дэвид Гилмор долгое время был вне новостных радаров. В 2014 году он неожиданно появился с сольным альбомом и объявил мировое турне в 2015 — в год, когда ему исполнялось 69 лет. Вот она — не исключено, что последняя — возможность услышать песни и гитарные соло от самого автора.</p>
  <p>Тогда я совсем не понимал как покупаются билеты на европейские концерты, какие службы проверенные, где гарантии и т.п. Проблема была в том, что заграницей все доступные билеты сразу выпускали в продажу, их в течение минут или часов после старта скупали, а потом перепродавали на других площадках в несколько раз дороже. По этой причине с 2015 годом не задалось.</p>
  <p>В начале 2016 было объявлено о новом европейском турне. За несколько дней сообщили о времени старта продаж билетов, оно было одинаковым почти для всех концертов тура. В час икс были открыты вкладки со всеми датами. Ажиотаж снова был дикий. Через 15 минут уже было забронировано 3/4 мест в <a class="link" href="wiesbaden.2016">Висбадене</a>, куда мне и удалось ухватить билет. Логика выбора города была простой — неважно в какой он стране, лишь бы место на площадке поближе и получше. Выпал 2 ряд — отлично! Германия, значит, Германия.</p>
  <p>Билет прислали курьерской службой прямиком из Германии за 25 евро — какая трата денег клиентов в век электронных билетов! Незачет ticketmaster.de, незачет. Тем более с билета только сканером код считали при входе, а сам он остался в абсолютно первозданном виде. Еще меня долго беспокоил нюанс, что транслитерация моего имени на русской банковской карте отличается от таковой в загранпаспорте: Sergey и Sergei. И в билете было не так, как в документе, который я предъявлял. Но это никакой роли не сыграло — пустили.</p>
  <p>Предполагалось, что этот концерт станет первым посещенным заграницей, но потом в график вписался <a class="link" href="rammstein.2016.07">Раммштайн</a> на неделю раньше в той же Германии.</p>
@endru

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/davidgilmour.2016.07.18.png'])
  <ol>
    <li>5 A.M.</li>
    <li>Rattle That Lock</li>
    <li>Faces of Stone</li>
    <li>What Do You Want From Me</li>
    <li>The Blue</li>
    <li>The Great Gig in the Sky</li>
    <li>A Boat Lies Waiting</li>
    <li>Wish You Were Here</li>
    <li>Money</li>
    <li>In Any Tongue</li>
    <li>High Hopes</li>
    <li>One of These Days</li>
    <li>Shine On You Crazy Diamond (Parts I-V)</li>
    <li>Fat Old Sun</li>
    <li>Coming Back to Life</li>
    <li>On an Island</li>
    <li>The Girl in the Yellow Dress</li>
    <li>Today</li>
    <li>Sorrow</li>
    <li>Run Like Hell</li>
    <li>Time</li>
    <li>Breathe (Reprise)</li>
    <li>Comfortably Numb</li>
  </ol>
@endcomponent

@ru
  <p>В качестве эксперимента положил мобильник в карман с включенным диктофоном. Таким образом, я обзавелся записью на память сразу по окончании концерта. Качество вышло очень даже достойное, но диктофоном все же лучше не пользоваться — он выравнивает громкость в зависимости от шума окружения. Стоит бас-гитаре замолчать, так диктофон подкручивает громкость, и наоборот. Куда уместнее будет приложение, которое пишет звук как есть.</p>
  <p>Эмоции наглядно передает <a class="link" href="https://www.facebook.com/davidgilmour/videos/10154401307308574/">видос</a> с шоу в другой части света. Кайф!</p>
  <p>Стоит учитывать, что европейские концерты могут заканчиваться куда позднее 23:00. Это в России шуметь после этого времени нельзя. В Висбадене я это не учел. Шоу спокойно продолжалось, хоть и проходило в самом центре города под открытым небом. Пришлось уйти с последних двух песен, иначе бы опоздал на последний поезд до <a class="link" href="frankfurt.2016">Франкфурта</a>, из которого я ночным и последним рейсом дня отправлялся в Прагу. Благодаря раннему уходу, удалось оценить громкость звука — песни было слышно даже на вокзале в 1,5 км от сцены! Причем путь к вокзалу вбок от нее уходит, а не по прямой.</p>
@endru

@ru
  <p>Как выглядит заветный второй ряд.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1244.jpg'])

@ru
  <p>Сцена в перерыве.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1260.jpg'])

@ru
  <p>Несколько фотографий из интернета.</p>
@endru
@include('tpl.pic-arbitrary', ['pic' => '1.jpg', 'w' => 1000, 'h' => 627])
@include('tpl.pic-arbitrary', ['pic' => '2.jpg', 'w' => 938, 'h' => 750])
@include('tpl.pic-arbitrary', ['pic' => '3.jpg', 'w' => 1000, 'h' => 667])
@include('tpl.pic-arbitrary', ['pic' => '4.jpg', 'w' => 1000, 'h' => 667])
@include('tpl.pic-arbitrary', ['pic' => '5.jpg', 'w' => 1000, 'h' => 563])
@include('tpl.pic-arbitrary', ['pic' => '6.jpg', 'w' => 871, 'h' => 750])
@include('tpl.pic-arbitrary', ['pic' => '7.jpg', 'w' => 967, 'h' => 750])
@include('tpl.pic-arbitrary', ['pic' => '8.jpg', 'w' => 1000, 'h' => 654])
@include('tpl.pic-arbitrary', ['pic' => '9.jpg', 'w' => 1000, 'h' => 562])
@include('tpl.pic-arbitrary', ['pic' => '10.jpg', 'w' => 914, 'h' => 750])
@include('tpl.pic-arbitrary', ['pic' => '11.jpg', 'w' => 1000, 'h' => 750])

@ru
  <p>Первый концерт тура исполнялся в Польше совместно с оркестром и вышел в профессиональной съемке. Его запись показывали по телевизору, она представлена ниже. Кстати, тот концерт закончился около часа ночи, а место тоже посреди города. Сет немного отличается от Висбадена, но записи лучше все равно не найти.</p>
@endru
<p>
  <a class="link" href="https://vk.com/video_ext.php?oid=-63247104&id=456239059&hash=91a9d66af1c534cc&hd=3">
    @svg (film)
    @ru Смотреть концерт на сайте vk.com @en Watch the concert on vk.com @endru
  </a>
</p>

@ru
  <p>В мае 2020 года стала доступна профессиональная запись концерта, снятого в Помпеях за несколько дней до Висбадена.</p>
@endru
<livewire:youtube title="David Gilmour - Live At Pompeii (Full Concert)" v="NAmOdxZKWjY"/>
@endsection

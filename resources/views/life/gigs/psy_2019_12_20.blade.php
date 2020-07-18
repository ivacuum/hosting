@extends('life.gigs.base')

{{-- Olympic Gymnastics Arena (KSPO DOME) --}}

@section('content')
@ru
  <p>Билеты в Корею были куплены заранее на распродаже Аэрофлота почти вдвое дешевле, чем <a class="link" href="psy.2018">в прошлом году</a>. Распродажа авиакомпании закончилась раньше, чем были объявлены даты концертов, поэтому выбирать пришлось на основе догадок и прошлогоднего опыта. Выбрал вылет 19 декабря. Удачно, потому что первый концерт оказался как раз в день прилета — 20 декабря.</p>
@endru

@ru
  <p>Было очень много сомнений стоит ли брать билеты на все рождественские концерты или ограничиться лишь одним. В какой-то момент решил, что лучше взять на все, потому что корейские тусы всегда феноменально заряжали. Для эксперимента решил каждую ночь проводить в разных секторах танцпола.</p>
@endru

@ru
  <p>Так как это уже третий посещаемый концерт, то в целом уже ясно по какому сценарию все проходит. Поэтому большинство вводной информации остается в историях о <a class="link" href="psy.2018">первом</a> и <a class="link" href="psy.2019.07">втором</a> концертах, а далее лишь описываются отличительные и невиданные черты.</p>
@endru

@ru
  <p>Новый баннер.</p>
@en
  <p>New banner.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4448.jpg'])

@ru
  <p>На билете был входной номер 300. По опыту предыдущих концертов, было логичным встать в очередь с номерами 241–360. В самый ее конец. Так и было сделано, но ребята рядом говорили, мол, вы не на своем месте стоите. При этом объяснить куда правильно следует встать они не смогли.</p>
@endru

@ru
  <p>Новый свет. Первая ночь проведена слева от сцены.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4450.jpg'])

@ru
  <p>Концерт начался с представления нового сингла <a class="link" href="https://www.youtube.com/watch?v=MllMdzj3uvo">White Night</a>. Люди уже подпевали, хотя песня появилась всего парой дней ранее. Затем традиционные правила поведения на концерте и церемония открытия шоу. Удалось даже найти <a class="link" href="https://www.youtube.com/watch?v=G2h28WQTnf8">трек</a>, под который проводилась церемония открытия.</p>
@endru
<livewire:youtube title="[4K] 191220 싸이 PSY - 오프닝, I LUV IT 2019 싸이 올나잇스탠드 광끼의 갓싸이 by veneto" v="Q45pvgd0_Fs"/>

@ru
  <p>Поздравление с наступающим Рождеством.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4451.jpg'])

@ru
  <p>Снежок.</p>
@en
  <p>Snow.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4454.jpg'])

@ru
  <p>Пауза во время драйвовой песни о Корее.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4455.jpg'])

@ru
  <p>Внезапное появление оркестра из семидесяти человек на сцене. В 3 часа утра!</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_4458.jpg',
  'IMG_4463.jpg',
]])

@ru
  <p>Видео последней песни. Время примерно 4:40 утра, часть зала уже разошлась.</p>
@endru
<livewire:youtube title="191220 PSY (싸이) — It's Art (예술이야) Encore, All Night Stand (올나잇스탠드), Live 2019-12-20" v="mb8W1cExAP8"/>

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/psy.2019.12.20.jpg'])
  <h5 class="mb-1">@ru Сет @en Set @endru 1</h5>
  <ol class="list-inside pl-0">
    <li><a class="link" href="https://www.youtube.com/watch?v=Q45pvgd0_Fs&t=595">I LUV IT</a></li>
    <li>오늘밤 새 <span class="text-sm text-muted">All Night Long</span></li>
    <li>끝 <span class="text-sm text-muted">The End</span></li>
    <li>내 눈에는 <span class="text-sm text-muted">In My Eyes</span></li>
    <li>New Face</li>
    <li>새 <span class="text-sm text-muted">Bird</span></li>
    <li>GENTLEMAN</li>
  </ol>

  <h5 class="mt-4 mb-1">@ru Сет @en Set @endru 2</h5>
  <ol class="list-inside pl-0" start="8">
    <li>챔피언 <span class="text-sm text-muted">Champion</span></li>
    <li>나팔바지 <span class="text-sm text-muted">Napal Baji</span></li>
    <li>어땠을까 <span class="text-sm text-muted">What Would Have Been</span></li>
    <li>DADDY</li>
    <li>나 이런 사람이야 <span class="text-sm text-muted">I'm a Guy Like This</span></li>
    <li>White Night</li>
  </ol>

  <h5 class="mt-4 mb-1">@ru Сет @en Set @endru 3</h5>
  <ol class="list-inside pl-0" start="14">
    <li>Right Now</li>
    <li>아버지 <span class="text-sm text-muted">Father</span></li>
    <li>흔들어 주세요 <span class="text-sm text-muted">Shake It</span></li>
    <li>낙원 <span class="text-sm text-muted">Paradise</span></li>
    <li>강남스타일 <span class="text-sm text-muted">Gangnam Style</span></li>
  </ol>

  <h5 class="mt-4 mb-1">@ru Сет @en Set @endru 4</h5>
  <ol class="list-inside pl-0" start="19">
    <li>We are the One</li>
    <li>연예인 <span class="text-sm text-muted">Entertainer</span></li>
    <li>Sigh</li>
    <li><a class="link" href="https://www.youtube.com/watch?v=aIkXxFt8_dw">에술이야</a> <span class="text-sm text-muted">It's Art</span></li>
  </ol>

  <h5 class="mt-4 mb-1">Encore 1</h5>
  <ol class="list-inside pl-0" start="23">
    <li>순정</li>
    <li>쿵따리 샤바라</li>
    <li>Tears</li>
    <li>맨발의 청춘</li>
    <li>와</li>
    <li>Run to you</li>
    <li>기댈곳 <span class="text-sm text-muted">Refuge</span></li>
    <li>왼손잡이</li>
    <li>붉은 노을</li>
    <li>나는 나비</li>
    <li>아파트</li>
    <li>말달리자</li>
    <li>그대에게</li>
    <li>여행을 떠나요</li>
    <li>마지막 장면 <span class="text-sm text-muted">Last Scene</span></li>
  </ol>

  <h5 class="mt-4 mb-1">Encore 2</h5>
  <ol class="list-inside pl-0" start="38">
    <li>챔피언 <span class="text-sm text-muted">Champion</span></li>
    <li><a class="link" href="https://www.youtube.com/watch?v=SuAwlBDyBc0">연예인</a> <span class="text-sm text-muted">Entertainer</span></li>
    <li>강남스타일 <span class="text-sm text-muted">Gangnam Style</span></li>
    <li>언젠가는 <span class="text-sm text-muted">Someday</span></li>
    <li>에술이야 <span class="text-sm text-muted">It's Art</span></li>
  </ol>
@endcomponent

@ru
  <p>По завершении концерта без проблем подняться с танцпола на трибуны и присесть отдохнуть.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4475.jpg'])

@ru
  <p>Коллаж официальных фотографий концерта. С помощью свайпа влево можно посмотреть его полностью.</p>
@en
  <p>Official concert photos collage. Swipe left to see it entirely.</p>
@endru
@include('tpl.pic-collage', ['pic' => 'collage.jpg', 'w' => 5400, 'h' => 540])

@ru
  <p>Субъективно, в первую ночь публика больше визжала, чем в остальные дни. Многие люди были с прозрачными пакетами для вещей, в которые запихивали верхнюю одежду и напитки, а потом кидали их на пол или в углах секторов. Куртки нередко перекидывали через перила ограджений — я тоже пуховик так оставлял.</p>
@endru

@ru
  <p>В первую ночь не была задействована диско-шар-голова. Освещение на песне It's Art было на манер 2018 года. Нашлось видео с прекрасным ракурсом.</p>
@endru
<livewire:youtube title="[4K] 191220 싸이 PSY - 예술이야 2019 싸이 올나잇스탠드 광끼의 갓싸이 by veneto" v="aIkXxFt8_dw"/>

@ru
  <p>Операторы были по всему стадиону и снимали людей для показа на большом экране. В левом переднем секторе танцпола они вылавливали людей на входе в сектор. Прям нацеливались на кого-нибудь и минуту или больше снимали. Режиссер принимал решение показать это видео на больших экранах или проигнорировать. Так что можно было показательно что-нибудь вытворять перед камерой и не попасть на экран.</p>
@endru
@endsection

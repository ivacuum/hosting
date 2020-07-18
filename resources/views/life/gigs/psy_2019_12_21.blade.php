@extends('life.gigs.base')

{{-- Olympic Gymnastics Arena (KSPO DOME) --}}

@section('content')
@ru
  <p>Всего через 19 часов после первой ночи начинается второй концерт.</p>
@endru

@ru
  <p>Через дорогу от Олимпийского парка, в котором расположен искомый стадион KSPO DOME, есть Бургер Кинг. На просьбу сделать неострый бургер сотрудник уточнил: «Что, совсем без соуса?». Да, совсем. И все равно бургер оказался острым, даже без соуса. Не знаю как корейцы это делают. Зато это поспособствовало интересному наблюдению: отголоски острой еды в горле во время пения вызывают жжение, которое подозрительно похоже на таковое после водки.</p>
@endru

@ru
  <p>Сегодня оранжевый билет. Четкое входное место 419. Четкое потому что на месте попался заинтересованный сотрудник, который нашел обладателей мест 418 и 420 и сказал вставать между ними. То есть, очередь на вход предопределена в момент покупки билетов. Именно это ребята-соседи в очереди не смогли объяснить днем ранее.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4857.jpg'])

@ru
  <p>Фотозона. Стоять всю ночь. Версия 2019 года.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4488.jpg'])

@ru
  <p>Вторая ночь проведена справа от сцены. Лазерное шоу на третьей песне.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_4493.jpg',
  'IMG_4495.jpg',
]])

@ru
  <p>Вот эти лазеры вживую выглядели словно паутина.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4494.jpg'])

@ru
  <p>Понравился свет в центре зала.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_4499.jpg',
  'IMG_4502.jpg',
]])

@ru
  <p>Первый гость на сцене.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4505.jpg'])

@ru
  <p>Рождество наступает.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4506.jpg'])

@ru
  <p>В первую ночь диско-голова не была задействована. А со второй по четвертую стала частью шоу.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_4509.jpg',
  'IMG_4512.jpg',
  'IMG_4514.jpg',
]])

@ru
  <p>Диско-сет из хитов минувших десятилетий. Непросто было их все найти, но теперь они перечислены ниже в сетлисте. Там оказались треки восьмидесятых, девяностых и нулевых. Публика очень ярко их встречает!</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_4515.jpg',
  'IMG_4520.jpg',
]])

@ru
  <p>Обращение на камеру к залу.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4523.jpg'])

@ru
  <p>Прослушивание реакции.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4527.jpg'])

@ru
  <p>Похоже на сетлист у оператора. Дальность нахождения и качество снимка не позволяют разглядеть детали.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4529.jpg'])

@ru
  <p>Уборка по завершении концерта в пять утра.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4530.jpg'])

@ru
  <p>Не все спешат расходиться, но скоро всех попросят покинуть помещение — примерно через 15–20 минут после окончания концертной программы. Многие строят на мобилах маршруты с помощью общественного транспорта, который вот-вот начнет ходить.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4532.jpg'])

@ru
  <p>За вторую ночь удалось в блокноте зафиксировать все исполненные песни и их порядок. В этом помог прошлогодний сет, в котором по большей части оставалось лишь подвигать песни местами.</p>
@endru

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/psy.2019.12.20.jpg'])
  <h5 class="mb-1">@ru Сет @en Set @endru 1</h5>
  <ol class="list-inside pl-0">
    <li>I LUV IT</li>
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
    <li>에술이야 <span class="text-sm text-muted">It's Art</span></li>
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
    <li>연예인 <span class="text-sm text-muted">Entertainer</span></li>
    <li>강남스타일 <span class="text-sm text-muted">Gangnam Style</span></li>
    <li>언젠가는 <span class="text-sm text-muted">Someday</span></li>
    <li>에술이야 <span class="text-sm text-muted">It's Art</span></li>
  </ol>
@endcomponent

@ru
  <p>Коллаж официальных фотографий концерта. С помощью свайпа влево можно посмотреть его полностью.</p>
@en
  <p>Official concert photos collage. Swipe left to see it entirely.</p>
@endru
@include('tpl.pic-collage', ['pic' => 'collage.jpg', 'w' => 5400, 'h' => 540])

@ru
  <p>Эта и песня и реакция публики на нее не перестают вдохновлять и заряжать. Даже если ходить на концерты каждый день.</p>
@endru
<livewire:youtube title="191221 PSY (싸이) — Entertainer (연예인이) Encore, All Night Stand (올나잇스탠드), Live 2019-12-21" v="4qWy3QAkApA"/>

@ru
  <p>Видеозапись концерта в восьми частях. Со всеми тремя гостями.</p>
@endru
<livewire:youtube title="191221~22 광끼의 갓싸이 1부 Full ver. 싸이 올나잇 스탠드 2019" v="QxZEeB7EWDo"/>
<livewire:youtube title="191221~22 Guest 1 크러쉬 Full ver. 싸이 올나잇 스탠드 2019" v="7eZ5Rn-pkUw"/>
<livewire:youtube title="191221~22 광끼의 갓싸이 2부 Full ver. 싸이 올나잇 스탠드 2019" v="ku6Eau8UTV4"/>
<livewire:youtube title="191221~22 Guest 2 헤이즈 Full ver. 싸이 올나잇 스탠드 2019" v="j38gjggr8mY"/>
<livewire:youtube title="191221~22 광끼의 갓싸이 3부 Full ver. 싸이 올나잇 스탠드 2019" v="52iNeluqHpo"/>
<livewire:youtube title="191221~22 Guest 3 MFBTY Full ver. 싸이 올나잇 스탠드 2019" v="XL-y3gEld40"/>
<livewire:youtube title="191221~22 광끼의 갓싸이 4부 Full ver. 싸이 올나잇 스탠드 2019" v="uuBuQA7z-pU"/>
<livewire:youtube title="191221~22 광끼의 갓싸이 - 앵콜 Full ver. 싸이 올나잇 스탠드 2019" v="X7NVGSgJVwU"/>

@endsection

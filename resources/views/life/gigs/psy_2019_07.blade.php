@extends('life.gigs.base')

{{-- Suwon World Cup Stadium --}}

@section('content')
@ru
  <p>В истории о предыдущем посещенном концерте Сая упоминается желание посетить летнее водное шоу. В итоге первый концерт летнего тура выпадает на мой день рождения. Было решено лететь именно на него, пока в Корее еще не самая парилка — про их лето часто можно встретить отзывы, что оно невыносимо душное, как и в Японии.</p>
@endru

@ru
  <p>Что из себя представляет водное шоу? Есть прекрасный клип, который появился прямо в день концерта. Четыре часа за четыре минуты — быстрее и нагляднее не объяснишь.</p>
@endru
<livewire:youtube title="Summer Swag Show" v="xqusJtwPC2k"/>

@ru
  <p>Типов билетов всего два: стоячие и сидячие. Стоимость стоячих мест поближе к сцене составляла <span class="whitespace-no-wrap">132&thinsp;000</span> корейских вон, подальше — за <span class="whitespace-no-wrap">121&thinsp;000</span> вон. Те же две цены для сидячих мест на трибунах по центру и по краям. Курс корейской воны относительно российского рубля с зимы упал на 15% — хорошая скидка вышла.</p>
@endru

@ru
  <p>В зоне проведения концерта все начинает работать за четыре часа до начала. Именно тогда можно получить на руки ранее оплаченный билет на шоу. Также доступны фудкорт, мерч и фотозоны.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4305.jpg'])

@ru
  <p>Очередь фотографироваться на фоне баннера.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4309.jpg'])

@ru
  <p>Лавки с мерчем. Удивительно, но стилизованные кроксы тут всего <span class="whitespace-no-wrap">38 евро</span> или <span class="whitespace-no-wrap">2800 ₽</span>. Это дешевле, чем довелось купить в Москве на той же неделе. Футболка всего <span class="whitespace-no-wrap">1050 ₽</span> или <span class="whitespace-no-wrap">14 евро</span>.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4311.jpg'])

@ru
  <p>Народ активно закупал водонепроницаемые чехлы, чтобы пользоваться мобилами. Но удовольствие в этом сомнительное, потому что звук нормально не запишешь, плюс по чехлу течет вода, искажая картинку. Также непонятно как пользоваться сенсорным экраном через прослойку. Так как телефон у меня был не водонепроницаемый, то было решено оставить его дома, ведь иначе он бы не выжил. Из-за этого понадобилось запоминать путь домой и коды от подъезда и квартиры. Деньги тоже остались дома.</p>
@endru

@ru
  <p>Также у публики пользовались популярностью водостойкие наклейки-тату. На концерт даже семьями приходили. И обклеивались тоже семьями. Есть у Сая песня Enternainer, которую в лоб можно перевести как Развлекатор — вот именно этим он на сцене и занимается, поэтому довольными остаются все.</p>
@endru

@ru
  <p>Место получения билетов. Непонятное в какое окно обращаться, ведь они тут по корейскому алфавиту, а у меня нет корейских букв в имени. Поэтому приходится прибегнуть к брутфорсу и обращаться во все по порядку.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4313.jpg'])

@ru
  <p>Туалеты на территории стадиона в форме футбольного мяча.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4316.jpg'])

@ru
  <p>На стадион шибко рано идти занимать очередь смысла нет, потому что на билете указано в какой волне запустят. Мне досталось 1438 место — это в волне с номерами от 1251 до 1500.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4317.jpg'])

@ru
  <p>На стадионе многослойный резиновый настил, чтобы уберечь газон от десятков тысяч местных и не очень местных скакунов. Публика снова на 99% корейская.</p>
@endru

@ru
  <p>Воду не только не отбирали на входе, но и бесплатно дали рюкзак с веревочными ручками, внутри которого была дополнительная 0,55 л бутылка воды и дождевик. Вот рюкзак.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4322.jpg'])

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/psy.2019.07.13.jpg', 'includeTitle' => false])
  @ru
    <div class="mb-1">Примерный сет-лист.</div>
  @en
    <div class="mb-1">Setlist.</div>
  @endru
  <h5 class="mb-1">@ru Сет @en Set @endru 1</h5>
  <ol class="list-inside pl-0">
    <li>챔피언 <span class="text-sm text-muted">Champion</span></li>
    <li>연예인 <span class="text-sm text-muted">Entertainer</span></li>
    <li>내 눈에는 <span class="text-sm text-muted">In My Eyes</span></li>
    <li>흔들어 주세요 <span class="text-sm text-muted">Shake It</span></li>
    <li>I LUV IT</li>
    <li>어땠을까 <span class="text-sm text-muted">What Would Have Been</span></li>
    <li>오늘밤 새 <span class="text-sm text-muted">All Night Long</span></li>
  </ol>

  <h5 class="mt-4 mb-1">@ru Сет @en Set @endru 2</h5>
  <ol class="list-inside pl-0" start="8">
    <li>Right Now</li>
    <li>GENTLEMAN</li>
    <li>아버지 <span class="text-sm text-muted">Father</span></li>
    <li>새 <span class="text-sm text-muted">Bird</span></li>
    <li>나팔바지 <span class="text-sm text-muted">Napal Baji</span></li>
    <li>DADDY</li>
  </ol>

  <h5 class="mt-4 mb-1">@ru Сет @en Set @endru 3</h5>
  <ol class="list-inside pl-0" start="14">
    <li>New Face</li>
    <li>Dream</li>
    <li>나 이런 사람이야 <span class="text-sm text-muted">I'm a Guy Like This</span></li>
    <li>강남스타일 <span class="text-sm text-muted">Gangnam Style</span></li>
    <li>낙원 <span class="text-sm text-muted">Paradise</span></li>
    <li>We are the One</li>
  </ol>

  <h5 class="mt-4 mb-1">Encore 1</h5>
  <ol class="list-inside pl-0" start="20">
    <li>Dance medley</li>
    <li>기댈곳 <span class="text-sm text-muted">Refuge</span></li>
    <li>Rock medley</li>
    <li>언젠가는 <span class="text-sm text-muted">Someday</span></li>
  </ol>

  <h5 class="mt-4 mb-1">Encore 2</h5>
  <ol class="list-inside pl-0" start="24">
    <li>에술이야 <span class="text-sm text-muted">It's Art</span></li>
    <li>마지막 장면 <span class="text-sm text-muted">Last Scene</span></li>
    <li>챔피언 <span class="text-sm text-muted">Champion</span></li>
    <li>연예인 <span class="text-sm text-muted">Entertainer</span></li>
    <li>Celeb</li>
  </ol>
@endcomponent

@ru
  <p>Поливалово было настолько мощным, что на второй песне уже промок до нитки. Хорошо, что телефон не стал брать с собой. Во время обливаний главное было не смотреть вверх, иначе вода попадала прямо в глаза, что заставляло их закрывать. Лучше было смотреть строго прямо или чуть ниже, чтобы вода безобидно стекала по лицу.</p>
@endru

@ru
  <p>Показали два клипа на новые и невиданные песни. Первый из них в конце шоу наполовину исполнили, когда казалось, что мероприятие уже закончилось. Странно было смотреть второй клип на концерте, потому что он был грустный. Гробовая тишина ведь во время просмотра.</p>
@endru

@ru
  <p>Выступление с двумя гостями уложилось в четыре часа. Возможно, самое короткое в этом летнем туре. Костюмы новые, но сет практически тот же, что и зимой. Даже несколько меньше песен было. Интересно как публика и Сай поделили кто что поет. Как-то отпадает смысл целиком разучивать куплеты.</p>
@endru

@ru
  <p>Корейцы в основном смотрят на экран на сцене, особенно когда Сай уходит за спину в центр танцпола. Вот он, вроде, рядом стоит и сбоку смотрит на них, а большинство все равно на него крупного на экране смотрит.</p>
@endru

@ru
  <p>Во время второго выхода на бис Сай спросил какие песни мы хотим, чтобы он исполнил повторно. Мнения разделились между левой и правой половинами стадиона. В итоге мы уговорили исполнить обе песни. Танцоры при этом жестами просили не уговаривать на вторую.</p>
@endru

@ru
  <p>Рюкзак был плотно затянут весь концерт, но в него все равно набралось столько воды, что хоть вычерпывай ее кружкой.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4320.jpg'])

@ru
  <p>В рюкзаке был билет. Вот так он пережил водное шоу.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4325.jpg'])

@ru
  <p>Чей-то влог о концерте в Сувоне. В нем краткая сводка о шоу.</p>
@endru
<livewire:youtube title="VLOG" v="n3_k7fc1MYw"/>

@ru
  <p>Впервые в интернете нашлась полная видеозапись концерта. Еще и летнего. Ни вода, ни пять часов продолжительности не помешали оператору все запечатлеть. Правда, записал он последний концерта тура — в Тэджоне. Из Сувона сложно найти что-то нагляднее, чем упомянутый выше влог.</p>
@endru
<livewire:youtube title="PSY 2019 Summer Swag, Daejeon, Set 1, Set 2, Set 3" v="kAyvn15zdr8"/>
<livewire:youtube title="PSY 2019 Summer Swag, Daejeon, Encore 1, Encore 2" v="pdQViEcdl7c"/>

<h3 class="mt-12">@ru Бонусные материалы @en Bonus materials @endru</h3>
<ul>
  <li><a class="link" href="https://youtu.be/H0UJ0UaooAs?t=1843">@ru Лав камера @en Love camera @endru</a></li>
  <li><a class="link" href="https://www.instagram.com/p/B10Rg-5BAxa/">@ru Минутная нарезка о концерте в Инчхоне @en Incheon 1-minute compilation @endru</a></li>
</ul>
@endsection

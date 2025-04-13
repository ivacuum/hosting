@extends('life.gigs.base')

{{-- Olympic Gymnastics Arena (KSPO DOME) --}}

@section('content')
@ru
  <p>Начнем с предыстории. Впервые про Сая услышал в августе 2012 года во время просмотра ежегодного чемпионата по Доте 2. У песни <a class="link" href="https://www.youtube.com/watch?v=9bZkp7q19f0">Гангнам стайл</a> тогда было «всего» несколько сотен миллионов просмотров, но к декабрю того же года она преодолела рубеж в миллиард, став международным хитом. Тогда еще вычитал, что у Сая в послужном списке было уже шесть альбомов.</p>
@endru

@ru
  <p>2013 год. Заглянул на его канал вновь — тогда появился сингл Джентльмен. Тоже бомбический трек.</p>
@endru

@ru
  <p>2018 год. В очередной раз вспомнил про Сая на рубеже лета и осени. И в этот раз меня унесло. Попалась куча концертных видосов, причем поиск на корейском выдавал куда более интересные результаты, в том числе любительские записи с полей. Вместе с этим был изучен официальный твиттер и инстаграм.</p>
@endru

@ru
  <div class="mb-1">Самые вау-находки:</div>
  <ul class="mb-4">
    <li>Пожалуй, <a class="link" href="https://youtu.be/XyzhL74DgA0?t=439">самая шумная и активная концертная публика</a>, что доводилось видеть</li>
    <li><a class="link" href="https://www.instagram.com/p/Bmn_AwEn7F8/">Летние фонтаны #1</a></li>
    <li><a class="link" href="https://www.instagram.com/p/BXhGj0BBAUN/">Летние фонтаны #2</a></li>
    <li><a class="link" href="https://youtu.be/yvmkFTW9IeM?t=1165">Зрители тоже в ответ обдают водой</a></li>
    <li><a class="link" href="https://twitter.com/psy_oppa/status/1000049482673766400">Нарезка со сцены и сбоку</a>: ошеломляющая громкость публики и полное ощущение, что во время Гангнам стайла происходит землетрясение</li>
    <li><a class="link" href="https://youtu.be/CnV_f3VPv4s?t=668">Каково на танцполе находиться</a>, когда включаются фонтаны</li>
    <li>За пределами сценами в правой части видео <a class="link" href="https://youtu.be/5PJ_gYi9fKM?t=306">девушка словно из подтанцовки</a></li>
    <li>Забыли воду на сцене поставить? <a class="link" href="https://youtu.be/5PJ_gYi9fKM?t=814">Не проблема</a></li>
    <li>А может ли публика сама песню исполнить? <a class="link" href="https://youtu.be/XfB3zXcpyB0?t=1735">Может!</a></li>
  </ul>
@endru

@ru
  <p>Самая проблема видосов по ссылкам выше — их сложно найти на даже английском. Про поиск на русском можно сразу забыть. Копировал отдельные корейские слова и вставлял в поисковую строку Ютуба.</p>
@endru

@ru
  <div class="mb-1">В августе закончилась пора летних концертов. Спустя некоторое время для каждого города появлялась официальная минутная видеонарезка.</div>
  <ul class="mb-4">
    <li><a class="link" href="https://twitter.com/psy_oppa/status/1045491184452304896">Сеул</a></li>
    <li><a class="link" href="https://twitter.com/psy_oppa/status/1040402670777819136">Пусан</a></li>
    <li><a class="link" href="https://twitter.com/psy_oppa/status/1042341109135958017">Тэгу</a></li>
    <li><a class="link" href="https://twitter.com/psy_oppa/status/1048097603290685440">Тэджон</a></li>
    <li><a class="link" href="https://twitter.com/psy_oppa/status/1052073363189915648">Инчхон</a></li>
    <li><a class="link" href="https://twitter.com/psy_oppa/status/1054890619452121088">Кванджу</a></li>
  </ul>
@endru

@ru
  <p>Понял, что хочу увидеть потрясающую корейскую публику вживую, подписался на твиттер Сая и стал ждать. Забегая вперед, отмечу, что стоило подписываться на инстаграм, так как у него он в разы активнее.</p>
@endru

@ru
  <p><span class="font-bold">Обновление от 10 февраля 2019 года.</span> Появилась полная запись самого активного концерта, который больше всего зарядил желанием оказаться среди корейской публики. Рекомендую моменты на <a class="link" href="https://youtu.be/cJgK1T3uzBU?t=463
">7:43</a>, <a class="link" href="https://youtu.be/cJgK1T3uzBU?t=525
">8:45</a> и <a class="link" href="https://youtu.be/cJgK1T3uzBU?t=2830">47:10</a> — прыгает весь стадион, включая трибуны! Где еще такое увидишь?!</p>
@endru
<livewire:youtube title="PSY Live @ Korea Univ. IPSELENTI 2018" v="cJgK1T3uzBU"/>

<h3 class="font-medium text-2xl mb-2 mt-12">@ru Анонс и покупка билета @en Announcement and ticket purchase @endru</h3>

@ru
  <p>13 ноября 2018 года перед сном — около двух ночи по Москве — решил проверить ленту твиттера, а там внезапный анонс.</p>
@endru
@include('tpl.pic-arbitrary-2x', ['pic' => 'announcement.jpg', 'w' => 375, 'h' => 375])

@ru
  <p>Ни дат, ни цен, ни города. Только время старта продаж и адрес сайта, на котором будут продаваться билеты. Восемь часов вечера по корейскому времени — это 14:00 по Москве, то есть, уже через 12 часов, как раз когда у меня запись к стоматологу.</p>
@endru

@ru
  <p>Наступает утро все того же 13 ноября. Появляются даты: 21, 22, 23 и 24 декабря. Интересное время начала — 23:42 по местному времени. Время окончания неизвестно. Локация — крытый гимнастический стадион. Поиск в Гугле ничего не дает — на английском буквально десяток результатов поиска, которые ведут на страницы-заглушки об артисте на сайтах американских билетных агентств со времен чеса на пике популярности Гангнам стайла.</p>
@endru

@ru
  <p>В 14:00 стартовала продажа билетов, добраться до сайта после стоматолога смог только около 15:00. И что мы видим? Уже пустоватенько — всего несколько десятков мест осталось из тысяч, да и при выборе тех оставшихся сайт ругается на корейском. Хорошо хоть у сайта вообще была международная (английская) версия.</p>
@endru
@include('tpl.pic-arbitrary-2x', ['pic' => 'ticket-01.png', 'w' => 1126, 'h' => 844])

@ru
  <p>Пришлось овладеть навыком скоростного нажатия F5 и моментального выбора ячейки. Эдак с десятой попытки получилось урвать билет в самый ближний к сцене стоячий сектор. <span class="whitespace-nowrap">145&thinsp;000</span> вон — это около <span class="whitespace-nowrap">9&thinsp;000</span> рублей. Так-то конвертер валют вам может показать сумму меньше, но еще ж двойная конвертация валют, которая суммарно съест дополнительные 5–10%.</p>
@endru
@include('tpl.pic-arbitrary-2x', ['pic' => 'ticket-02.png', 'w' => 1096, 'h' => 750])

@ru
  <p>Получение билета только на месте проведения. Окей, потом разберемся как это сделать.</p>
@endru
@include('tpl.pic-arbitrary-2x', ['pic' => 'ticket-03.png', 'w' => 1096, 'h' => 809])

@ru
  <p>Условия возврата. У билета на танцпол порядковый номер 770. Что это значит? Простая формальность? Видимо, узнаю позже.</p>
@endru
@include('tpl.pic-arbitrary-2x', ['pic' => 'ticket-04.png', 'w' => 1096, 'h' => 809])

<h3 class="font-medium text-2xl mb-2 mt-12">@ru Предконцертная подготовка @en Preparation @endru</h3>

@ru
  <p>В твиттере после анонса сохранялась полная тишина. Ближе к декабрю меня посетила светлая мысль «а не проверить-ка ли мне инстаграм?». Вот где оказалась вся движуха. Там и сводка о поле и возрасте купивших билеты, объявление о красном дресс-коде на концерт, примеры ожидаемого мерча, анонс, что все билеты распроданы, и прочая полезная инфа.</p>
@endru

@ru
  <p>Все это хорошо, но хотелось бы подготовиться к песням. А какие будут исполняться? Тут обратился к видосам летних концертов и набросал десяток любимых и знакомых. Задача максимум была хотя бы эти десять припевов разучить. Для этого надо было научиться читать оригинал или найти такие версии, которые поддаются чтению без его знания.</p>
@endru

@ru
  <p>Выяснилось, что существует романизация или кириллизация. В первом случае делается транскрипция текстов в латиницу, а во втором, соответственно, в кириллицу. С романизацией все плохо — она не предназначена для передачи звучания. В ней <em>eo</em> читается как <em>о</em>, <em>eu</em> читается как <em>ы</em>, <em>s</em> может читаться как <em>с</em>, так и как <em>ш</em>, и т.д. Сразу понял, что это не мой вариант, и отбросил ее. Кириллизацию читать элементарно, но с ней другая беда — текстов на кириллице исчезающе мало.</p>
@endru

@ru
  <p>Проведем небольшую демонстрацию на примере припева песни 아버지 (отец).</p>
  <div class="mb-1 font-bold">Оригинал:</div>
  <p>아버지 이제야 깨달아요<br>어찌 그렇게 사셨나요?<br>더 이상 쓸쓸해 하지 마요<br>이젠 나와 같이 가요</p>
  <div class="mb-1 font-bold">Романизация:</div>
  <p>abeoji ijeya kkaedarayo<br>eojji geureoke sasyeonnayo<br>deo isang sseulsseulhae haji mayo<br>ije nawa gachi gayo</p>
  <div class="mb-1 font-bold">Кириллизация:</div>
  <p>абоджи иджэя кэда лаё<br>оджи кырокэ сашёт наё<br>до исан сыль сыль хэ хаджи маё<br>иджэн наоа катщи каё</p>
@endru

@ru
  <p>Разница в простоте громадна. <a class="link" href="https://youtu.be/neajytrw2SQ?t=109">Включаем трек</a> и поражаемся как легко подпевать по кириллице. Кайф же органично влиться в голосистую толпу, а не тихо тупить в сторонке.</p>
@endru

@ru
  <p>Окей, выбрали кириллицу. Где ее взять, если песню никто не переводил? Сделать кириллизацию самому. Всего-то за день разучить простой корейский алфавит, по нему по буквам написать строчку за строчку на кириллице, а затем слушать песню, исправляя найденные в тексте ошибки. На скриншоте процесс изучения алфавита и весьма экзотичной раскладки клавиатуры. Пример собственной кириллизации двумя абзацами выше в припеве песни.</p>
@endru
@include('tpl.pic-arbitrary-2x', ['pic' => 'korean-keyboard.png', 'w' => 1440, 'h' => 900])

@ru
  <p>Изначальной цели с разучиванием десяти припевов не удалось достичь — меня хватило лишь на восемь.</p>
@endru

@ru
  <p>После летних видосов было немало сомнений про фонтаны воды — как потом на улицу выходить? А какую обувь брать под танцевальную музыку зимой? Как вообще одеваться в канун рождества? И часов до трех ночи управимся?</p>
@endru

@ru
  <p>Видосы рождественских концертов прошлых лет подсказали, что вода только на открытом воздухе, то есть летом. Фух. По обуви на концерт рекомендация прямо на странице покупки билета — кроссовки или что-то подобное. Остается непонятным как в кроссовках ходить зимой. По одежде официальную рекомендацию Гугл перевел как «трусы и полушубок» — прям как шерсть у льва в районе шеи —, то есть летняя одежда под низ и зимняя куртка сверху. Название шоу All Night Stand вселяет сомнения, что получится управиться до трех ночи. Формат не новый — Сай проводил подобные рождественские концерты в 2017, 2016, 2015, 2014, 2013, 2011, 2010 и прочие годы. Однако, ни одного концерта нет в записи целиком, чтобы можно было понять все происходящее. Максимум на Ютубе найдутся отдельные песни.</p>
@endru

@ru
  <p>Заблаговременно вспомнил как разминался дома за неделю до <a class="link" href="prodigy.2016">концерта Продиджи</a> в 2016 году. Собрал примерный сетлист и пропрыгал его. Было очень похоже на прыжки на скакалке в течение 30–40 минут. На следующий день ноги ожидаемо отваливались. Еще через день полегче. Еще на день позже наступил кайф. Зато на следующий после их концерта день никаких болезненных ощущений. Для этого концерта повторил подготовку. Спойлер — она снова безупречно сработала, поэтому рекомендую всем попробовать подход.</p>
@endru

<h3 class="font-medium text-2xl mb-2 mt-12">@ru День концерта @en The day of the show @endru</h3>

@ru
  <p>Вы прибыли к месту назначения. Крытый гимнастический стадион. Неподалеку отсюда был стол, на котором представлены <a class="link" href="https://www.instagram.com/p/BrjrbthhnTN/">все продаваемые товары</a> (мерч). Самое удивительное, что около этого стола не было никого со стороны организатора. Посетители просто подходили, брали и рассматривали вещи, а потом возвращали их на место. Более того — в палатках по соседству бесплатно раздавали кофе всем <span class="whitespace-nowrap">12&thinsp;500</span> участникам концерта.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5896.jpg'])

@ru
  <p>Теперь нужно получить бумажный билет в этом киоске, открывающимся за три часа до начала концерта. В момент фото остается уже немногим более часа до старта. Очереди по секторам, написанным на бумаге. Знать бы только что на них написано. Из крайней левой жестом отправили правее, из следующей еще правее. Пятая по счету оказалась нужной. Девушка пригласила рукой подойти к ней, нашла именной билет, сверила данные с паспортными и вручила конверт.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5897.jpg'])

@ru
  <p>Заветный именной билет в конверте. К использовании имен еще вернемся позднее в этой заметке.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5900.jpg'])

@ru
  <p>Теперь очередь на запуск. Группы не более 120 человек. На билете видно место номер 770 — это мне в очередь 721~840.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5902.jpg'])

@ru
  <p>Как одеты люди в очереди уже заметили? Если нет, то вот товарищ пришел прямиком с летнего концерта. На улице -3&deg;C, по ощущениям все -10&deg;C. Ближе к утру будет еще холоднее. В зимней одежде немного прохладно, но летняя обувь по ощущениям самый раз.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5904.jpg'])

@ru
  <p>Хм, так если каждый пятый в футболке и штанах или шортах, то где же они вещи оставили? В машине? Ну да, наверное.</p>
@endru

@ru
  <p>Еще будучи в очереди, персонал попросил самостоятельно оторвать корешки от билетов. Странно. Было не по себе отрывать — вдруг не пустят? Но когда стоял постоянный хруст отрыва, то сомнений в правильности сего действия не оставалось никаких.</p>
@endru

@ru
  <p>Начинают запускать. Проходим дальше и отдаем корешок билета. Что удивительно — никакого досмотра и металлодетекторов. Даже в билеты не всматривались. До зала остается буквально один поворот, но в зимних вещах не прикольно. В область зрения попадает сотрудник, у которого производится попытка выведать где тут гардероб. Ему на помощь приходит один из посетителей концерта, выступая переводчиком между английским и корейским. Оказывается, есть только платные камеры хранения на улице, а внутри стадиона гардероба нет. Бегом туда, пока шоу не началось. Высокий дядька-охранник с рацией открывает дверь, чтобы выпустить. Везде уже ограждения поставили и прекратили массовый запуск. Персонал у каждого ограждения подсказывал куда дальше бежать, чтобы добраться до камер хранения. Ура, нашлись. Новая очередь. Не пускают. Собирается человек пять персонала в попытке смущенно объяснить на английском, что все камеры хранения переполнены, и место закончилось. Окей, придется в зимних вещах заходить. Бегом обратно в зал. Снова надо отстаивать очередь. Но на повторный вход остались считанные сотни людей.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5907.jpg'])

@ru
  <p>Снова сбор корешков от билетов. Упс, а взять-то их на выходе никто не догадался. Остается ждать в сторонке, чтобы попытаться объяснить ситуацию, когда основная масса народа пройдет. О, за дверьми знакомый персонаж с рацией. Попытка привлечь его внимание возымела эффект, и он вышел на улицу. Спросил у него можно ли нам войти, на что он собирающим билеты сказал нечто вроде «пропустите их». Ура, снова <a class="link" href="https://www.youtube.com/watch?v=CcmKtGS1d3U">ближе к цели</a>.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5908.jpg'])

@ru
  <p>Кто-то остается в зимней одежде, но большинство, конечно, раздевается. Куда же деть вещи? Сбоку была замечена свалка пакетов (скорее всего после шопинга, в том числе мерчем) и разной одежды. Точно! Можно просто кинуть все теплые вещи на ограждение сбоку. Да хоть на пол. Так и одеться можно будет сразу после выступления. Еще и бесплатно. Паспорт внутри пальто? Да и фиг с ним.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5911.jpg'])

@ru
  <p>Погасили свет, стало ярко видно весь купленный мерч. Начинается!</p>
@en
  <p>Lights off. Now all merchandise people bought is clearly visible. Show is starting!</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5914.jpg'])

@ru
  <p>Понеслась.</p>
@en
  <p>Show is on.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5927.jpg'])

@ru
  <p>Каждые песен пять стреляли зарядом конфетти.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5934.jpg'])

@ru
  <p>Свет. Сай в этот раз выступал светорежиссером собственного концерта. Получился качественный рывок вперед по зрелищности, поэтому концерты прошлых лет теперь тяжело смотреть, ведь не покидает стойкое ощущение, что там света не было вовсе.</p>
@en
  <p>The light. PSY was the light director of his own show this time.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_5964.jpg',
  'IMG_5984.jpg',
  'IMG_5985.jpg',
  'IMG_5987.jpg',
  'IMG_5991.jpg',
]])

@ru
  <p>О, да.</p>
@en
  <p>Oh yes.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_6048.jpg',
  'IMG_6062.jpg',
]])

@ru
  <p>Еще кадры разных песен.</p>
@en
  <p>More shots of different songs.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_6078.jpg',
  'IMG_6108.jpg',
  'IMG_6130.jpg',
]])

@ru
  <p>Он улетел, но обещал <s>вернуться</s> спуститься.</p>
@en
  <p>He flew away but promised to come down.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_6119.jpg'])

@ru
  <p>Концерт закончился.</p>
@en
  <p>Show is over.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_6177.jpg',
  'IMG_6178.jpg',
  'IMG_6196.jpg',
  'IMG_6199.jpg',
]])

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/psy.2018.12.23.jpg', 'includeTitle' => false])
  @ru
    <div class="mb-1">Что было исполнено. На каждую песню можно нажать и посмотреть видео. Сердечком отмечен самый смак.</div>
  @en
    <div class="mb-1">Setlist. Each song is a link to its video. The most spectacular are marked with a heart.</div>
  @endru
  <h5 class="font-medium text-lg mb-1">@ru Сет @en Set @endru 1</h5>
  <ol class="list-inside pl-0">
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=e5VriO_mdv8">챔피언</a>
      <span class="text-sm text-gray-500">Champion</span>
      <span class="text-red-600">@svg (heart)</span>
    </li>
    <li><a class="link" href="https://www.youtube.com/watch?v=OcRA6dwfdW4">I LUV IT</a></li>
    <li><a class="link" href="https://www.youtube.com/watch?v=ztZnqo0IJA4">I Remember You</a></li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=vVmkMz0OwfM">내 눈에는</a>
      <span class="text-sm text-gray-500">In My Eyes</span>
    </li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=KOW6APjojWw">나 이런 사람이야</a>
      <span class="text-sm text-gray-500">I'm a Guy Like This</span>
      <span class="text-red-600">@svg (heart)</span>
    </li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=_HVIq803T2U">새</a>
      <span class="text-sm text-gray-500">Bird</span>
    </li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=ddyyKt_hr2Q">오늘밤 새</a>
      <span class="text-sm text-gray-500">All Night Long</span>
      <span class="text-red-600">@svg (heart)</span>
    </li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">@ru Сет @en Set @endru 2</h5>
  <ol class="list-inside pl-0" start="8">
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=vjpYGfYCnqI">We are the One</a>
      <span class="text-red-600">@svg (heart)</span>
    </li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=MauVE6F3nMo">나팔바지</a>
      <span class="text-sm text-gray-500">Napal Baji</span>
      <span class="text-red-600">@svg (heart)</span>
    </li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=5TT4qvedULU">끝</a>
      <span class="text-sm text-gray-500">The End</span>
      <span class="text-red-600">@svg (heart)</span>
    </li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=N59H7TgwC24">DADDY</a>
      <span class="text-red-600">@svg (heart)</span>
    </li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=j5yKlTTDxPY">흔들어 주세요</a>
      <span class="text-sm text-gray-500">Shake It</span>
    </li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=gxavJwXQc0M">어땠을까 (feat. 헤이즈)</a>
      <span class="text-sm text-gray-500">What Would Have Been</span>
    </li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">@ru Сет @en Set @endru 3</h5>
  <ol class="list-inside pl-0" start="14">
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=4tnCBnhEGX4">Right Now</a>
      <span class="text-red-600">@svg (heart)</span>
    </li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=4tnCBnhEGX4&t=272">GENTLEMAN</a>
      <span class="text-red-600">@svg (heart)</span>
    </li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=E21OCvoJKJQ">아버지</a>
      <span class="text-sm text-gray-500">Father</span>
      <span class="text-red-600">@svg (heart)</span>
    </li>
    <li><a class="link" href="https://www.youtube.com/watch?v=WUB9kZMSMFw">New Face</a></li>
    <li><a class="link" href="https://www.youtube.com/watch?v=XIH5tFK9eU8">Dream</a></li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=8GksPfIR9uA">강남스타일</a>
      <span class="text-sm text-gray-500">Gangnam Style</span>
    </li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">@ru Сет @en Set @endru 4</h5>
  <ol class="list-inside pl-0" start="20">
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=dptfI1Nfe5M">낙원</a>
      <span class="text-sm text-gray-500">Paradise</span>
    </li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=JwgVC1YKMs4">걱정말아요 그대</a>
      <span class="text-sm text-gray-500">Don't Worry</span>
      <span class="text-red-600">@svg (heart)</span>
    </li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=bzj_NOpg1vQ">연예인</a>
      <span class="text-sm text-gray-500">Entertainer</span>
      <span class="text-red-600">@svg (heart)</span>
    </li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=MWqBXsNYrgM">에술이야</a>
      <span class="text-sm text-gray-500">It's Art</span>
      <span class="text-red-600">@svg (heart)</span>
    </li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1"><a class="link" href="https://www.youtube.com/watch?v=vwEn2rh4RUw">Encore 1</a></h5>
  <ol class="list-inside pl-0" start="24">
    <li><a class="link" href="https://www.youtube.com/watch?v=PsTLjzWw0pQ">Dance medley</a></li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=qqj1OIpDAgY">기댈곳</a>
      <span class="text-sm text-gray-500">Refuge</span>
    </li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=dG0uq27J77Q">Rock medley</a>
      <span class="text-red-600">@svg (heart)</span>
    </li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=8YL4NvSleAc">마지막 장면</a>
      <span class="text-sm text-gray-500">Last Scene</span>
      <span class="text-red-600">@svg (heart)</span>
    </li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">Encore 2</h5>
  <ol class="list-inside pl-0" start="28">
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=RwX6OxhcvYM">챔피언</a>
      <span class="text-sm text-gray-500">Champion</span>
      <span class="text-red-600">@svg (heart)</span>
    </li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=qeCAoacwaIk">강남스타일</a>
      <span class="text-sm text-gray-500">Gangnam Style</span>
      <span class="text-red-600">@svg (heart)</span>
    </li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=nz6bswnz9KM">언젠가는</a>
      <span class="text-sm text-gray-500">Someday</span>
    </li>
  </ol>
@endcomponent

@ru
  <p>После сетов 1, 2 и 3 были приглашенные местные звезды, которые исполняли 3–4 песни. Где-то в районе четвертого сета Сай сказал волшебную фразу энкор (на бис). Далее мы ее повторяли практически после каждой песни. <a class="link" href="https://youtu.be/vwEn2rh4RUw?t=77">Пример</a>. И он выходил петь и танцевать еще и еще. Даже после тридцатой повторяли — и он снова вышел. Говорил минуту-другую что-то непонятное и совсем ушел.</p>
@endru

@ru
  <p>Сколько же длился концерт? Изначально думал часа в три ночи уже лягу спать. Не тут-то было. Если взять тридцать песен Сая, прибавить десяток песен приглашенных исполнителей, умножить на какие-нибудь средние шесть минут, то уже выходит 40&times;6=240 минут или 4 часа! Оценка близка к действительности, потому что концерт шел с 23:45 до примерно 05:00. Откуда еще лишний час? Все исполнители немало болтали с публикой, особенно Сай. Он не раз вылавливал кого-нибудь взглядом на трибунах или танцполе, просил оператора показать человека на большом экране и вел с ним беседу. Остается загадкой о чем именно он говорил, так как навык понимания корейского на слух у меня отсутствует. Несколько раз он просил весь зал замолчать, а своего собеседника закричать изо всех сил — и кричавшего при этом было отлично слышно где именно в зале он находится. <a class="link" href="https://youtu.be/YlHKylJtvTw?t=441">Пример</a>. Также однажды на экране показывали людей в возрасте, посетивших концерт.</p>
@endru

@ru
  <p>Официальная <a class="link" href="https://twitter.com/psy_oppa/status/1085471072684666886">видеонарезка о концерте</a>. Как <a class="link" href="https://www.instagram.com/p/BrvqNNIBs_P/">тусили в 4:40 утра</a>.</p>
@endru

@ru
  <p>Во время одной из пауз на экранах показали много-много текста. Слайды каждые несколько секунд менялись. Сначала подумал титры с организаторами.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_6174.jpg'])

@ru
  <p>В определенный момент стало ясно, что это имена и фамилии присутствующих. У корейцев они суммарно из трех слогов. Последний слайд содержал имена на одной латинице. Буквально несколько десятков имен из <span class="whitespace-nowrap">12&thinsp;500</span> посетителей! <a class="link" href="https://youtu.be/mixE6js4dps?t=242">Видео</a>.</p>
@endru
@include('tpl.pic-arbitrary', ['pic' => 'names.png', 'w' => 462, 'h' => 351])

@ru
  <p>Посетители побежали занимать очередь в камеру хранения, чтобы забрать зимние вещи и утеплиться.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_6201.jpg',
  'IMG_6206.jpg',
]])

@ru
  <p>Все-таки здоровский оказался способ оставить вещи прямо в зале — не мерзнешь на улице после выхода. В летней обуви тоже комфортно оказалось дойти до дома, тем более квартира была арендована прямо через дорогу от места проведения, поэтому ноги за 15 минут никак бы не отвалились в -7&deg;C.</p>
@endru

@ru
  <p>Концерт и публика задали высочайшую планку по впечатлениям, которую неизвестно теперь чем превзойти. Поездка однозначно стоила того. Даже <a class="link" href="rammstein.2016.07">Раммштайн в Берлине</a> так не принимали. Может потому что в Берлине прямо на площадке люди пили пиво, а в Сеуле всех снабжали кофе?</p>
@endru

<h3 class="font-medium text-2xl mb-2 mt-12">@ru Собственные видео @en My own videos @endru</h3>
@ru
  <p>Впервые записал на концерте пачку собственных видосов. Было пофиг на качество и стабилизацию — самому было интересно какой выйдет результат. Вдруг на память что достойное останется. Плюс актуально было записывать спокойные и неизвестные песни, все равно подпевать не мог. Записал в итоге десять видосов, из которых выделил бы всего один: 29-й трек из сета, где на экране сам себя заснял. Но смотреть лучше всего равно ту версию, что по ссылке в сете, так как она с нормальной стабилизацией и лучшим качеством.</p>
@endru
<livewire:youtube title="Gangnam Style (강남스타일)" v="i5klAF-1Qww"/>

@ru
  <p>Движущаяся дополнительная сцена.</p>
@en
  <p>Moving second scene.</p>
@endru
<livewire:youtube title="GENTLEMAN (젠틀맨)" v="Nvf6nYJDf5k"/>

@ru
  <p>Активные песни.</p>
@en
  <p>Energetic songs.</p>
@endru
<livewire:youtube title="We are the one" v="V_BchYEfUAY"/>
<livewire:youtube title="Napal Baji (나발바지)" v="i9qPaUptbmc"/>
<livewire:youtube title="DADDY" v="FkYjKUTRhpA"/>
<livewire:youtube title="Rock Medley (락 메들리)" v="PMaZCOVfejc"/>

@ru
  <p>Рок-аранжировка хип-хоп песни.</p>
@endru
<livewire:youtube title="The End (끝)" v="wqoHYT6z2Uw"/>

@ru
  <p>Медляки.</p>
@en
  <p>Slow songs.</p>
@endru
<livewire:youtube title="Place to Lean On / Refuge (기댈곳)" v="AAMGCLkW-yc"/>
<livewire:youtube title="Last Scene (마지막 장면)" v="z1q6Lgi2Bxo"/>
<livewire:youtube title="What would have been (어땠을까)" v="_aGExr31Zn4"/>

@ru
  <p>Полет.</p>
@en
  <p>Fly.</p>
@endru
<livewire:youtube title="Paradise (낙원)" v="H4lo6V-Bt60"/>

@ru
  <p>Полет завершился, а люди поют. Песня бородатых времен, плюс еще и кавер.</p>
@endru
<livewire:youtube title="Don't Worry (걱정말아요 그대)" v="OaXl57L2rTc"/>

<h3 class="font-medium text-2xl mb-2 mt-12">@ru Бонусные материалы @en Bonus materials @endru</h3>
@ru
  <ul>
    <li>Песня It's Art <a class="link" href="https://www.youtube.com/watch?v=1cKc1rkZwf8">в официальном клипе</a> из нарезки выступлений разных лет и <a class="link" href="https://www.youtube.com/watch?v=C3v2z75AizY&t=119">вживую</a>; на ней же <a class="link" href="https://www.youtube.com/watch?v=9g0WukEo0U0">трибуны ходят ходуном</a></li>
    <li>Полет на песне <a class="link" href="https://www.youtube.com/watch?v=DyW04ui2Sf0">Paradise</a>. Публике забавно предложили зачитать весьма быстрый рэп</li>
    <li>Продолжение полета на <a class="link" href="https://www.youtube.com/watch?v=hdAmWEemJmw">Don't Worry</a></li>
    <li>Лазерное шоу в полной красе с трибун: <a class="link" href="https://youtu.be/dm0bi47c6cY?t=246">пример 1</a>, <a class="link" href="https://youtu.be/rC6ss1D2ogU?t=257">пример 2</a></li>
  </ul>
@endru
@endsection

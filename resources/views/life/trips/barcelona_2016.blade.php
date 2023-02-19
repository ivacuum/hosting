@extends('life.trips.base')

@section('content')
@ru
  <p>Неужели пустыня?</p>
@en
  <p>Desert? Really?</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0067.jpg'])

@ru
  <p>Фух, не.</p>
@en
  <p>Oof, no.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0091.jpg'])

{{--
<p>Часто такое покрытие встречалось в самых разных городах. Для бега делают?</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0075.jpg'])
--}}

<a id="single-seats"></a>
@ru
  <p>Лавки в любом городе найдутся, а вот стульчики на одного — редкость.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0096.jpg'])

@ru
  <p>Железнодорожная станция.</p>
@en
  <p>Railway station.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0178.jpg'])

@ru
  <p>Хорошо уложенные пути. На них в электричке нет типичного «ту-дух ту-дух», она двигается бесшумно и комфортно. На этом участке до следующей остановки поезд развивает скорость до 130 км/ч. Испанцы восхваляют свои железные дороги, особенно высокоскоростные. До Мадрида из Барселоны можно добраться менее чем за 3 часа — неплохо для шестисоткилометрового расстояния. Еще можно доехать до Парижа.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0077.jpg',
  'IMG_0078.jpg',
]])

@ru
  <p>Голосовые сообщения очень короткие: «следующая остановка такая-то». Все. Нет этих «уважаемые пассажиры, держитесь, пожалуйста, за поручни». Табло, как в поезде, так и на станции, загорается только при приближении поезда. Двери в составах полуавтоматические — открываются и внутри и снаружи по кнопке.</p>
@endru

@ru
  <p>Сами электрички хороши. С туалетом и кондиционером, местами для велосипедов и инвалидов.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0258.jpg',
  'IMG_0079.jpg',
  'IMG_0081.jpg',
]])

@ru
  <p>Машинист смотрит на дорогу через узкую щель. В солнцезащитных очках.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0260.jpg'])

@ru
  <p>На станции при необходимости из вагонов выезжает дополнительная ступенька.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0082.jpg'])

@ru
  <p>Автомат по продаже железнодорожных билетов. Renfe — название компании, rodalies — пригородное сообщение. Названия компаний помогают впоследствии найти их сайты и ознакомиться с вариантами логистики. Актуально фотографировать, например, автобусы, поезда и такси.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0184.jpg'])

@ru
  <p>Порой хорошо удаются снимки с множеством деталей. Акцент изначально здесь был на велосипеде с украденным передним колесом, но также видно название автобусной компании и зеркала для выезжающих из дворов водителей.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0080.jpg'])

@ru
  <p>Редкий трамвайчик.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0215.jpg'])

@ru
  <p>Красив его путь.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0216.jpg'])

@ru
  <p>Прекрасные здания.</p>
@en
  <p>Beautiful buildings.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0334.jpg',
  'IMG_0326.jpg',
  'IMG_0203.jpg',
  'IMG_0191.jpg',
  'IMG_0119.jpg',
  'IMG_0121.jpg',
]])

<a id="stairs"></a>
@ru
  <p>Подъем по длинной лестнице вознаграждается панорамным видом.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0297.jpg',
  'IMG_0299.jpg',
  'IMG_0300.jpg',
]])

@ru
  <p>Еще высотные виды.</p>
@en
  <p>More panoramic views.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0116.jpg',
  'IMG_0135.jpg',
]])

@ru
  <p>Неожиданно — футбольное поле на высоте.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0314.jpg'])

@ru
  <p>Спорту в городе отведено большое место.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0131.jpg'])

@ru
  <p>Особенно футболу. В мяч играют в любом удобном месте. Даже тут на дальнем плане.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0145.jpg'])

<a id="visor"></a>
@ru
  <p>Окна и балконы. Створки часто закрыты или прикрыты. Причем ткань на балконах одного цвета в пределах дома. Кондиционеры нельзя вешать на фасад здания, их можно разглядеть только внутри балконов.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0154.jpg',
  'IMG_0155.jpg',
  'IMG_0158.jpg',
  'IMG_0159.jpg',
  'IMG_0217.jpg',
]])

@ru
  <p>При заселении в гостиницу в Испании берут налог в зависимости от количества звезд у нее. В среднем это от 0,5 евро с человека в день за <span class="font-bold">3*</span> до 2,5 евро за <span class="font-bold">5*</span>. Цифры могут меняться в зависимости от региона и длительности проживания.</p>
@endru

@ru
  <p>Прозрачные подъезды.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0136.jpg',
  'IMG_0223.jpg',
]])

@ru
  <p>Мусорные баки выравнивают вдоль дороги. По высоте они выше легкового автомобиля. Некоторые баки можно открыть ногой, наступив на ручку внизу. Эти другой конструкции — без ручки.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0108.jpg'])

<a id="escalator"></a>
@ru
  <p>Для подъема наверх наряду со ступеньками и пандусами делают эскалаторы.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0142.jpg',
  'IMG_0114.jpg',
]])

@ru
  <p>Остановки.</p>
@en
  <p>Bus stops.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0163.jpg',
  'IMG_0102.jpg',
  'IMG_0213.jpg',
]])

@ru
  <p>Внезапно — попугаи на улице. На деревьях их сложно заметить, как и в траве.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0166.jpg'])

@ru
  <p>Почтовый ящик.</p>
@en
  <p>Postbox.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0218.jpg'])

@ru
  <p>Набережная. Видно какой сильный ветер в Барселоне.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0232.jpg'])

@ru
  <p>По фонтанам тоже заметно. Можно подгадать, чтобы за счет ветра обдало прохладной водой.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0251.jpg',
  'IMG_0204.jpg',
]])

@ru
  <p>Еще от жары помогают спасаться питьевые фонтанчики. Достаточно одного нажатия на кнопку — вода будет литься около 10 секунд. Такая же система, например, в аэропорту. Удобно, что после нажатия обе руки свободны.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0283.jpg'])

@ru
  <p>Пляж.</p>
@en
  <p>The beach.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0234.jpg'])

@ru
  <p>Малоизвестный у нас <a class="link" href="https://tema.livejournal.com/1755711.html" rel="nofollow">знак парикмахерской</a>.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0323.jpg'])

@ru
  <p>Столб с солнечной панелью, как в <a class="link" href="krasnodar.2016#sun_pole">Краснодаре</a>.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0288.jpg'])

@ru
  <p>Необычный жилой дом и городской прокат велосипедов.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0246.jpg'])

@ru
  <p>Антивандальное покрытие столба. Все равно умудряются прилепить рекламку.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0276.jpg'])

@ru
  <p>Автомат для оплаты парковки.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0267.jpg'])

@ru
  <p>Место для парковки мотоциклов и мопедов. Последних крайне много в городе — чуть ли не поровну с автомобилями.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0269.jpg'])

@ru
  <p>Цвет линий на асфальте имеет значение. Зеленый — жилые районы, выгодная парковка для резидентов.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0104.jpg',
  'IMG_0222.jpg',
  'IMG_0224.jpg',
]])

@ru
  <p>Синий — места платные в рабочее время. Перерыв на обед (сиеста) тут довольно длинный — 2–3 часа, которые парковка в этой зоне бесплатна. Но и заведения в это время закрыты.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0156.jpg'])

@ru
  <p>Дороги.</p>
@en
  <p>Roads.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0239.jpg',
  'IMG_0244.jpg',
  'IMG_0245.jpg',
  'IMG_0248.jpg',
  'IMG_0250.jpg',
  'IMG_0275.jpg',
  'IMG_0286.jpg',
  'IMG_0287.jpg',
  'IMG_0097.jpg',
  'IMG_0152.jpg',
  'IMG_0193.jpg',
  'IMG_0168.jpg',
  'IMG_0169.jpg',
  'IMG_0146.jpg',
  'IMG_0147.jpg',
  'IMG_0140.jpg',
]])

@ru
  <p>Вафля — запрещающая остановку на перекрестке разметка. Наглядное дополнение к ПДД.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0247.jpg'])

@ru
  <p>Заправка в центре города.</p>
@en
  <p>Gas station in the city center.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0329.jpg'])

@ru
  <p>Волнистый забор с интересной тенью.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0157.jpg'])

@ru
  <p>В общественном транспорте представляется наглядная возможность оценить разницу между языками. Справа вверху информация представлена сначала на каталонском, а затем на испанском. В городе встречается преимущественно один каталонский. Скачанный мною словарь испанского оказался бессилен. Впрочем, после десяти поездок на электричке понимаешь уже все объявления о них.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0339.jpg'])

@ru
  <p>Продукты местного производства имеют характерную черту — желтый ценник с надписью Producte local.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0340.jpg'])

@ru
  <p>Рынок.</p>
@en
  <p>The market.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0346.jpg'])

@ru
  <p>Ярмарка.</p>
@en
  <p>The fair.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0177.jpg'])

@ru
  <p>На углу дома табличка с названием улицы. Нумерация непосредственно над подъездами, так как у каждого свой номер. Почти как в <a class="link" href="kaliningrad.2015#house_number">Калининграде</a>.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0294.jpg'])

@ru
  <p>Приятно погулять.</p>
@en
  <p>It's pleasure to walk.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0174.jpg',
  'IMG_0328.jpg',
  'IMG_0332.jpg',
  'IMG_0149.jpg',
  'IMG_0129.jpg',
  'IMG_0130.jpg',
]])

@ru
  <p>Напоследок несколько видео. Наслаждение смотреть 60 кадров в секунду.</p>
  <p>Как выглядит улица в центре.</p>
@endru
<livewire:youtube title="Barcelona street, May 2016" v="bh5oaJbD_z8"/>

@ru
  <p>Аттракцион #1 в Порте Авентура неподалеку от Барселоны.</p>
@en
  <p>Attraction #1 in Port Aventura not so far away from Barcelona.</p>
@endru
<livewire:youtube title="Port Aventura boats, June 2016" v="DqKHyp8IWyc"/>

@ru
  <p>Аттракцион #2.</p>
@en
  <p>Attraction #2.</p>
@endru
<livewire:youtube title="Port Aventura splash, June 2016" v="UAXCpzBtnYM"/>

@ru
  <p>Видишь сову? Нет? А она есть.</p>
@en
  <p>Do you see an owl? No? Yet it's there.</p>
  {{-- Do you see an owl? Me neither. But there is one. --}}
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0330.jpg'])
@endsection

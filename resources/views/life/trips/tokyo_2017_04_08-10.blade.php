@extends('life.trips.base')

@section('content')
@ru
  <p>Рейс японской авиакомпанией JAL. Билеты удалось с горем пополам — с пятого раза — урвать по очень привлекательной цене (даже ниже Аэрофлота) еще во время нахождения на <a class="link" href="bali.2016">Бали</a>. С этого момента началась подготовка к поездке. Можно смело сказать, что к настоящему моменту приготовления были самые масштабные. Японцы хотят быть в курсе каждого дня пребывания в стране вплоть до контактов отеля.</p>
@en
  <p>Flight by Japanese airline—JAL. Tickets were bought while in <a class="link" href="bali.2016">Bali</a>. Preparation for the trip began from that moment. I can surely say by now that the preparations were the most comprehensive. The Japanese want to be aware of every day of stay in the country—even accommodations' contacts and things you want to do in cities.</p>
@endru

@ru
  <p>Отдельное спасибо стоит сказать человеку, вдохновившему на поездку и устроившему большую ее часть. Спасибо!</p>
@en
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3838.jpg'])

@ru
  <p>Перелет на Боинге 787 (Дримлайнер). Затемнение окон. Всего пять положений. Слева самое темное, справа самое светлое. Снимки с разным уровнем яркости, чтобы можно было оценить разницу.</p>
@en
  <p>Flight on a Boeing 787 (Dreamliner). Windows use smart glass allowing to adjust five levels of sunlight and visibility. Level one is on the left, and level five is on the right. Pictures are with different exposure level, so it's easier to notice the difference.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3840.jpg',
  'IMG_3842.jpg',
  'IMG_3845.jpg',
]])

@ru
  <p>Перелет около 10 часов, за это время кормят дважды. Но эти два раза так растянуты, что ощущение, что ешь чуть ли не весь полет. Поспать дольше пары часов не удалось. По предыдущему положительному опыту было вновь заказано кошерное питание. И здесь оно не подкачало. Однако, удивило, что бортпроводники спрашивали можно ли им самим разогреть кошерную пищу или я схожу и проконтролирую процесс. А также просили вскрыть упаковку с едой и убедиться, что там все ОК, что никаких неожиданностей среди блюд. Ага, понимать бы еще что там внутри!</p>
@en
  <p>Flight is about 10 hours long, you get two meals during it. But meals are so big, that it feels like the only thing you do the entire flight is eat. I couldn't sleep for more than a couple of hours. Kosher meal was ordered given the previous positive experience. And it was good once again. However, it was surprising that flight attendant asked if she could warm up my kosher meal by herself or I would go with her and control the process. I was also asked to open the meal box and make sure everything is OK inside. Yeah, I wish I knew what's inside!</p>
@endru

@ru
  <p>За час-два до посадки всю еду повторили. Это снова, грубо говоря, пять блюд.</p>
@en
  <p>The second meal was given few hours before landing. It's roughly five courses once again.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3850.jpg'])

@ru
  <p>На табло пишут, что перелет в Токио, хотя на самом деле он в город Нарита к востоку от столицы. До Токио еще ехать на общественном транспорте. Уже тут уйма вариантов: автобус или поезд, поезд JR или поезд Keisei, поезд-экспресс или электричка.</p>
@en
  <p>Display reports the flight is to Tokyo, but in fact it is to Narita—city to the east of the capital. There are lots of options how to get to Tokyo by public transport: bus or train, JR train or Keisei train, express train or regular train.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3852.jpg'])

@ru
  <p>По счастливому стечению обстоятельств с начала 2017 года стало возможным подавать на туристическую визу самостоятельно. Если это делать в консульстве, то процедура бесплатная. Разве что нужно самому привозить и забирать паспорт. Если подавать через Пони Экспресс, то можно заказать доставку домой.</p>
@en
  <p>Russians need to get visa in advance. Prior to 2017 it was not possible without Japanese travel agency. Fortunately, since the beginning of 2017 we can apply for a visa by ourselves. If you apply in Japanese consulate in Moscow, visa costs you nothing. The only caveat is that you can't get your passport delivered to your home then.</p>
@endru

@ru
  <p>Набор документов стал повторять таковой для Шенгенской визы, но с парой отличий: дополнение в виде плана поездки и необязательность наличия медицинской страховки. В таблице ниже пример двух дней плана поездки. Да, заполнять все документы нужно на английском.</p>
@en
  <p>The application is now almost the same as for Schengen visa, but with a couple of differences: schedule of stay is mandatory, and medical insurance is optional. You can find an example of two days of schedule of stay in a table below.</p>
@endru
<table class="table-stats mb-3">
  <thead>
  <tr>
    <th>Date</th>
    <th>Activity Plan</th>
    <th>Con&shy;tact</th>
    <th>Accom&shy;moda&shy;tion</th>
  </tr>
  </thead>
  <tbody>
  <tr>
    {{-- Пробелы для переноса строк на мобилах --}}
    <td>08 / 04 / 2017</td>
    <td>
      <div>Flight JL 422 from Moscow.</div>
      <div>Arrival to Narita airport at 08:35</div>
    </td>
    <td>
      <div>+81 3 1539 7788</div>
      <div>Hotel Name</div>
    </td>
    <td>
      <div>Okamoto-machi 1-284</div>
      <div>Chuo Ward, Tokyo</div>
      <div>920-0906</div>
    </td>
  </tr>
  <tr>
    <td>09 / 04 / 2017</td>
    <td>Tours in Tokyo, train to Nikko</td>
    <td>—</td>
    <td>—</td>
  </tr>
  </tbody>
</table>
@include('tpl.pic-2x', ['pic' => 'IMG_3853.jpg'])

@ru
  <p>Добро пожаловать в Японию — страну восходящего солнца! И рано заходящего. Серьезно — в семь вечера темно круглый год.</p>
@en
  <p>Welcome to Japan—the land of the rising sun. And early setting sun. Seriously, it's dark at 7PM all year round.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3856.jpg'])

@ru
  <p>Аэропорт Нарита.</p>
@en
  <p>Narita airport.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3857.jpg'])

@ru
  <p>Экспресс до Токио ¥3000. На момент написания для перевода в рубли цены удобно делились пополам.</p>
@en
  <p>Express train to Tokyo costs ¥3000.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3863.jpg'])

@ru
  <p>Электричка до Токио ¥1000.</p>
@en
  <p>The regular train to Tokyo costs ¥1000.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3865.jpg'])

@ru
  <p>Висящие поручни четко на своих местах. Верхние полки часто используются японцами, чтобы не держать сумки даже несколько станций.</p>
@en
  <p>Grab handles are locked to their places, so they look symmetrical. The upper shelves see an often use by Japanese even if they are in for a few stops.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3867.jpg'])

@ru
  <p>Раз была выбрана дешевая электричка, то предстояло сделать две пересадки. Если есть интернет, то проблем с навигацией совсем не возникнет. Если нету, то желательно знать время отправления поездов или хотя бы нужное направление движения.</p>
@en
  <p>Since the regular train was picked, there are two changes en route to the hotel. If you have internet, there will be no problems with navigation at all. If you don't have it, it's best to know the time of the departure or at least the direction.</p>
@endru

@ru
  <p>Неважно на каком поезде доберетесь и по какому маршруту. Важно лишь где вы зашли и на какой станции вышли — между ними будет подсчитан оптимальный маршрут и списана соответствующая дальности сумма. Если недостаточно денег на транспортной карте или билете, то можно доплатить разницу сотруднику на выходе. Если денег совсем нет (забыли), то можно вернуться на исходную станцию и выйти там словно никуда и не ездили. Также можно пополнить транспортную карту вплоть до ¥20 000 в терминале на станции. Продуманы, что тут скажешь. У пассажира есть право на ошибку, и это радует.</p>
@en
  <p>In the end it doesn't even matter what train and what route you would take. There are two things that make up the cost of your ride: entrance and exit points. So you gonna be charged by the most optimal and the shortest route. If you have not enough money on your ticket or transport card, you can pay the difference to a man at the exit point. If you have no money at all (left a wallet at home, for example), you can ride back to the entrance point and exit like you didn't go anywhere. By the way transport card can be funded up to ¥20 000 right there at the station. Geniuses, what else can be said? Passenger has got a right to be wrong.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3868.jpg'])

@ru
  <p>Все места входа в вагоны подписаны. Этот для состава из восьми вагонов.</p>
@en
  <p>All the boarding points to the cars are signed. This one is for a train of eight cars.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3869.jpg'])

@ru
  <p>Рядом синий для другого состава.</p>
@en
  <p>Blue sign is for a different train.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3870.jpg'])

@ru
  <p>Следующая пересадка. На столбе две схемы. На верхней можно заметить, что станции имеют оригинальное название, на латинице, а также простое вида А09. Нижняя схема — метро. Да, веток много. Еще и присутствуют разные ж/д компании. Ехать лучше какой-то одной, тогда будет минимальная стоимость проезда. Потому что один вход и выход. Если переходить между компаниями, то каждый раз это новый вход и выход, соответственно и новая плата. Если строить маршрут через тот же Гугл мэпс, то он предложит как самый дешевый вариант, так и самый быстрый.</p>
@en
  <p>The next change. There are two schemes on the column. The stations on the upper one have hieroglyphic, latin and symbolic names. The lower one is metro map. Yeah, there are lots of lines. There are different railway companies as well. It is cheaper to pick just one for a single ride, because it's one entrance and one exit this way. You are charged when you change railway companies. When you use apps like Apple or Google maps for directions, they suggest cheapest and fastest options mixed, so double-check.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3871.jpg'])

@ru
  <p>Станция.</p>
@en
  <p>Railway station.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3872.jpg'])

@ru
  <p>Входы в вагоны действительно напротив надписей на полу.</p>
@en
  <p>Boarding points to the cars are really opposite the signs on the floor.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3874.jpg'])

@ru
  <p>На столбе название станции. Можно попрактиковаться в <a class="link" href="japanese">иероглифах</a>.</p>
@en
  <p>Name of the station on the column. It is time practice <a class="link" href="japanese">Japanese</a>.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3876.jpg'])

@ru
  <p>Автомат по продаже карты широкого назначения Pasmo. В Токио еще бывает карта Suica, которую и довелось опробовать. В других городах есть свои аналоги. Объединяет их то, что пользоваться ими можно по всей стране. Что ими делать? Прикладывать к турникетам, чтобы платить за транспорт. Прикладывать к считывателям в магазинах, чтобы платить за покупки. Обзавестись одной из карт лучше сразу прямо в аэропорту перед первым использованием общественного транспорта. С ней не придется искать название станции и стоимость проезда до нее, а затем покупать билет соответствующего номинала. В правой половине фотографии как раз станции и стоимость.</p>
@en
  <p>You can get Pasmo rechargeable contactless smart card from this ticket vending machine. There are also vending machines with Suica cards. Other parts of Japan have their own card analogs. What unites them is that they all can be used all over the country. What can you do with a smart card? Pay the fare by touching the ticket gates, for example. It's also gonna be your bank card replacement in Japan. It's better to get Pasmo or Suica right in the airport before your first use of public transport, so you don't need to look up your destination point in the table on the right side of the picture.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3877.jpg'])

@ru
  <p>В какой магазин не зайдешь, так там на входе будут журналы и газеты. Еще копир, принтер, кофе-машина, столики для еды, обязательно бесплатный туалет, а то и еще что-нибудь.</p>
@en
  <p>There are magazines and newspapers in every convenience store. Copy machine, printer, coffeemaker, tables to eat, free WC and maybe something else are also can be found.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3882.jpg'])

@ru
  <p>Пора уже, наконец, выйти на улицу.</p>
@en
  <p>It's time to finally take a look at the streets.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3883.jpg'])

@ru
  <p>Посмотреть на дороги.</p>
@en
  <p>And the roads.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3884.jpg',
  'IMG_3885.jpg',
]])

@ru
  <p>Деньги терминал отеля предлагает списать двумя способами:</p>
  <ol>
    <li>в валюте карты</li>
    <li>в иенах</li>
  </ol>
  <p>Второй вариант заметно выгоднее. Было 16 800 ₽ против 15 800 ₽.</p>
@en
@endru

@ru
  <p>Если втянуть живот, то можно протиснуться между домами.</p>
@en
  <p>If you pull in your belly, you can squeeze between the houses.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3886.jpg'])

@ru
  <p>Указатели на перекрестке.</p>
@en
  <p>Signs at the intersection.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3887.jpg'])

@ru
  <p>Зебры во все стороны. Можно переходить в любом направлении.</p>
@en
  <p>Road can be crossed in any direction.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3889.jpg'])

@ru
  <p>В туристическом месте не продохнуть.</p>
@en
  <p>Overcrowded touristic place.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3893.jpg'])

@ru
  <p>Сакура. Апрель — самое ее время в центральной части Японии.</p>
@en
  <p>Cherry blossoms. April is an ideal time to see it in central Japan.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3902.jpg',
  'IMG_3909.jpg',
  'IMG_3910.jpg',
  'IMG_3912.jpg',
  'IMG_3921.jpg',
]])

@ru
  <p>Храм.</p>
@en
  <p>Temple.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3903.jpg'])

@ru
  <p>Рядом с храмом.</p>
@en
  <p>Near the temple.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3905.jpg'])

@ru
  <p>Указатель пожарного гидранта.</p>
@en
  <p>Fire hydrant sign.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3904.jpg'])

@ru
  <p>На фоне обычные жилые дома.</p>
@en
  <p>Ordinary residential buildings in the background.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3906.jpg'])

@ru
  <p>Ворота под названием тории.</p>
@en
  <p>Gates like this one are called torii.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3916.jpg'])

@ru
  <p>Костюмы жутко популярны. В час пик чуть ли не половина людей в них.</p>
@en
  <p>Suits are quite popular. It's like half of the people are in costumes during peak hours.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3917.jpg'])

@ru
  <p>Автомобили и гос номера. Взять автомобиль в аренду не выйдет, так как наше международное водительское удостоверение недействительно в Японии. Мы подписали конвенции о дорожном движении разных годов. Нужно сдавать местный экзамен. Или иметь, например, американское в/у.</p>
@en
  <p>Cars and license plates.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3922.jpg'])

@ru
  <p>Автобус НАТО.</p>
@en
  <p>Nato (in Russian) bus.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3925.jpg'])

@ru
  <p>Рыбки плавают.</p>
@en
  <p>The fish are swimming.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3928.jpg',
  'IMG_3929.jpg',
]])

@ru
  <p>Просьба не кормить голубей, а то все засрут.</p>
@en
  <p>Don't feed the pigeons, or they will shit everything.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3930.jpg'])

@ru
  <p>Сетка на доме.</p>
@en
  <p>Net on the house.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3932.jpg'])

@ru
  <p>Похоже на лавку по продаже всякой всячины.</p>
@en
  <p>Shop or just yard?</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3933.jpg'])

@ru
  <p>Платная парковка. Места пронумерованы и разграничены. Машину в Японии просто так не купишь — нужно еще и парковочное место к ней иметь.</p>
@en
  <p>Parking. Spaces are clearly numbered and delineated. By the way it's not so easy to buy a car in Japan—you need to buy a parking space for it as well.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3934.jpg'])

@ru
  <p>Проезд закрыт. Камни берегут неподвижность ограждения.</p>
@en
  <p>No thoroughfare. Stones keep the barrier fixed.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3936.jpg'])

@ru
  <p>Прозрачный подъезд.</p>
@en
  <p>Transparent entrance.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3937.jpg'])

@ru
  <p>Вертикальный уличный указатель.</p>
@en
  <p>Vertical street sign.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3939.jpg'])

@ru
  <p>Дома совсем близко друг к другу. Автомобильные светофоры все время горизонтальные.</p>
@en
  <p>Buildings are very close to each other. Traffic light for cars in always horizontal.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3941.jpg'])

@ru
  <p>Снова упражнение по втягиванию живота.</p>
@en
  <p>One more exercise "pull in your belly".</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3942.jpg'])

@ru
  <p>Оранжевое и зеленое такси. Работают в нем в основном люди в возрасте, когда некуда уже податься. Дверь открывается и закрывается автоматически.</p>
@en
  <p>Orange and green taxies. Passenger's door opens and closes automatically.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3943.jpg'])

@ru
  <p>Низкопольный автобус.</p>
@en
  <p>Low-floor bus.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3944.jpg'])

@ru
  <p>Переулки.</p>
@en
  <p>Side streets.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3945.jpg',
  'IMG_3948.jpg',
]])

@ru
  <p>Угловой дом.</p>
@en
  <p>Corner house.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3946.jpg'])

@ru
  <p>Землетрясение застать не удалось, но они достаточно часты. На улице можно встретить указатели к паркам, которые и являются точкой эвакуации в случае землетрясений. В отелях встречаются брошюры с порядком действий в случае тряски.</p>
@en
  <p>There were no earthquakes during the trip, but they are frequent enough during the year. There are sings on the streets which lead to safety areas—parks. There are "what to do in an earthquake" booklets in the hotels' rooms.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3947.jpg'])

@ru
  <p>Не переходите здесь дорогу.</p>
@en
  <p>No pedestrian crossing sign.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3949.jpg'])

@ru
  <p>Улицы.</p>
@en
  <p>Streets.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3950.jpg',
  'IMG_3951.jpg',
  'IMG_3971.jpg',
]])

@ru
  <p>В парке на велике не разгонишься.</p>
@en
  <p>You won't accelerate much on a bicycle in the park.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3952.jpg'])

@ru
  <p>Пикники процветают. Дождь не помеха.</p>
@en
  <p>Picnics boom. Rain is not a trouble.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3954.jpg'])

@ru
  <p>Набережная.</p>
@en
  <p>Embankment.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3956.jpg',
  'IMG_3958.jpg',
  'IMG_3959.jpg',
  'IMG_3963.jpg',
  'IMG_3964.jpg',
  'IMG_3966.jpg',
  'IMG_3969.jpg',
]])

@ru
  <p>Пять пунктов номер один.</p>
@en
  <p>Five items number one.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3965.jpg'])

@ru
  <p>Чайки.</p>
@en
  <p>Seagulls.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3967.jpg',
  'IMG_3968.jpg',
]])

@ru
  <p>Таксофон.</p>
@en
  <p>Payphone.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3970.jpg'])

@ru
  <p>Почтовый ящик.</p>
@en
  <p>Postbox.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3972.jpg'])

@ru
  <p>Берешь бутылки, а сзади остальные сами подкатываются.</p>
@en
  <p>Take the bottle and the rest of the line will move forward.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3974.jpg'])

@ru
  <p>Пульт Мицубиши. Большие компании делают тут все, что могут.</p>
@en
  <p>Mitsubishi TV remote control. Large companies manufacture and construct everything they could.</p>
@endru
@include('tpl.pic-arbitrary', ['pic' => 'IMG_3979.jpg', 'w' => 563, 'h' => 750])

@ru
  <p>Многоуровневый город. Запросто можно ехать на метро на уровне седьмого этажа.</p>
@en
  <p>Multilevel city. You can catch yourself riding metro at the height of the seventh floor.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3980.jpg'])

@ru
  <p>Вид в другую сторону.</p>
@en
  <p>The view of the opposite side.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3981.jpg'])

@ru
  <p>Терминалов для транспортных карт хватит на всех.</p>
@en
  <p>Enough ticket vending machines for everybody.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3982.jpg'])

@ru
  <p>Обслуживание автоматов с водой. Выбор газировки ошеломляющий. Рядом с автоматами обязательно урна для бутылок и банок.</p>
@en
  <p>Beverage vending machines maintenance. A staggering variety of soda. There is always a bin for bottles and cans next to a vending machine.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3983.jpg'])

@ru
  <p>В метро.</p>
@en
  <p>In the metro.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3984.jpg'])

@ru
  <p>Во многих составах метро над каждым выходом из вагонов экраны показывают схему движения. Правый экран подловлен на корейском.</p>
@en
  <p>There are displays with route in many metro trains right above the exit. Caught right screen while in Korean.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4085.jpg'])

@ru
  <p>На улице. Да, первые деньки зонт был весьма актуален.</p>
@en
  <p>The weather outside. Yeah, it was really important to have an umbrella for the first few days of the trip.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3985.jpg'])

@ru
  <p>Состав без машиниста.</p>
@en
  <p>Driverless train.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3986.jpg'])

@ru
  <p>Станция метро U08.</p>
@en
  <p>Metro station U08.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3988.jpg'])

@ru
  <p>За окном станции.</p>
@en
  <p>Outside the station.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3989.jpg'])

@ru
  <p>Туалет на МКС.</p>
@en
  <p>Space toilet on the ISS.</p>
@endru
@include('tpl.pic-arbitrary', ['pic' => 'IMG_3990.jpg', 'w' => 563, 'h' => 750])

@ru
  <p>Земля.</p>
@en
  <p>Earth.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3992.jpg'])

@ru
  <p>Район Одайба.</p>
@en
  <p>Odaiba district.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3997.jpg',
  'IMG_3998.jpg',
]])

<a name="umbrella-cover"></a>
@ru
  <p>Чехлы для мокрых зонтов словно презервативы. Не принято капать в помещениях, поэтому либо чехол, либо оставлять зонт снаружи. Где? На парковках для зонтов, конечно же.</p>
@en
  <p>Condoms for wet umbrellas. Dripping is not appropriate in buildings, so it's either condom or leaving an umbrella in a stand outside an establishment.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3999.jpg'])

@ru
  <p>Макеты еды для упрощения выбора.</p>
@en
  <p>Food replicas to simplify the choice of dishes to order.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4001.jpg'])

@ru
  <p>Своя статуя Свободы.</p>
@en
  <p>Statue of Liberty replica.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4003.jpg'])

@ru
  <p>Мост.</p>
@en
  <p>Bridge.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4005.jpg'])

@ru
  <p>Американские машины.</p>
@en
  <p>American cars.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4006.jpg'])

@ru
  <p>Лавочка.</p>
@en
  <p>Bench.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4008.jpg'])

@ru
  <p>Здание.</p>
@en
  <p>Building.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4009.jpg'])

@ru
  <p>Велопарковка.</p>
@en
  <p>Bicycle parking.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4010.jpg'])

@ru
  <p>Колесо обозрения.</p>
@en
  <p>Ferris wheel.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4011.jpg'])

@ru
  <p>Метро.</p>
@en
  <p>Metro.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4048.jpg'])

@ru
  <p>Почтовые ящики в жилом доме. Почтальоны заходят к ним через отдельный вход и закидывают бумагу сзади.</p>
@en
  <p>Mailboxes in residential building. Postman comes to them through a separate entrance and puts the mail from the back.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4051.jpg'])

@ru
  <p>Для вещичек побольше есть камеры хранения. Посылку могут доставить прямо на дом, оставить в камере, а извещение закинуть в почтовый ящик, что вы могли по нему открыть камеру и забрать свою посылку.</p>
@en
  <p>There are lockers for big things. So you get the notification to your mailbox with the information how to open the locker with your parcel.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4052.jpg'])

@ru
  <p>В центре дома колодец. Так сейсмоустойчивость выше.</p>
@en
  <p>Courtyard. It increases the seismic resistance.</p>
@endru
@include('tpl.pic-arbitrary', ['pic' => 'IMG_4055.jpg', 'w' => 563, 'h' => 750])

@ru
  <p>Вид сверху.</p>
@en
  <p>Top view.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4056.jpg'])

@ru
  <p>Вид снизу.</p>
@en
  <p>Bottom view.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4058.jpg'])

@ru
  <p>По утрам в вагоны с такой маркировкой могут попасть только женщины.</p>
@en
  <p>Cars with this label are women only in the morning.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4059.jpg'])

@ru
  <p>Станция.</p>
@en
  <p>Railway station.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_4061.jpg',
  'IMG_4062.jpg',
]])

@ru
  <p>Район Шибуя.</p>
@en
  <p>Shibuya district.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4064.jpg'])

@ru
  <p>Можно переходить дорогу в любом направлении.</p>
@en
  <p>You can cross the road in any direction.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4065.jpg'])

@ru
  <p>Именно такие техногенные виды ассоциировались у меня с Японией до поездки.</p>
@en
  <p>This type of technogenic landscapes I had associated with Japan before the trip.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4067.jpg'])

@ru
  <p><s>Ночные</s> Вечерние улицы. Темнеет же рано.</p>
@en
  <p>Streets in the <s>night</s> evening. It gets dark early.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_4068.jpg',
  'IMG_4069.jpg',
  'IMG_4070.jpg',
]])

@ru
  <p>Еще ж/д станции.</p>
@en
  <p>More railway stations.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_4071.jpg',
  'IMG_4072.jpg',
]])

@ru
  <p>Сложно найти рюкзак без прицепленных штучек и игрушек. По эскалатору, как и по дорогам, ездят с левой стороны.</p>
@en
  <p>It's difficult to find a backpack without toys and stuff attached. Ride the escalator on the left side, just like on the road.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4086.jpg'])

@ru
  <p>Жвачка с интересными названиями.</p>
@en
  <p>Chewing gum.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4073.jpg'])

@ru
  <p>Прямо как скотч.</p>
@en
  <p>Just like an adhesive tape.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4074.jpg'])

@ru
  <p>Как есть в заведении с конвейером суши. Садишься перед конвейером, набираешь понравившихся проезжающих тарелок с едой и ешь. Стоит только встать, так к тебе подбегают с предложением счета. Цена по цвету и оформлению набранных тарелок.</p>
@en
  <p>How to eat in a place with rotating belt of sushi.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4079.jpg'])

@ru
  <p>Микроскопические отверстия для воды в душе.</p>
@en
  <p>Microscopic holes for water in the shower.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4081.jpg'])

@ru
  <p>Дожди закончились.</p>
@en
  <p>It's stopped raining.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4083.jpg'])
@endsection

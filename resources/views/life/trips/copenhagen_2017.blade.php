@extends('life.trips.base')

@section('content')
@ru
  <p>Что было известно о Дании заранее? Что она в Скандинавии и что в ней большое велосипедное движение.</p>
@en
  <p>What was known about Denmark before the trip? It is a part of Scandinavia and it has an enormous bicycle traffic.</p>
@endru

@ru
  <p>Что стало известно по ходу планирования поездки? Например, что стоимость аренды комнаты в 2–3 раза выше, чем в <a class="link" href="berlin.2017.05">Берлине</a>. Это сразу насторожило, так как весь тур изначально предполагался очень бюджетный. В Копенгагене все пошло под откос.</p>
@en
  <p>What have I learned during the planning phase? Accommodation in Copenhagen is a few times more expensive than in <a class="link" href="berlin.2017.05">Berlin</a>. I thought of a budget eurotrip at first, but that idea got derailed.</p>
@endru

@ru
  <p>Прекрасный аэропорт Копенгагена не удалось рассмотреть подробно. Прилет был поздний, надо было спешить заселяться. По пути на выход было заметно, что скоротать в нем несколько часов перед вылетом одно удовольствие.</p>
@en
  <p>Sadly, I had no time to explore the beautiful Copenhagen airport. It was late—like around midnight—arrival, so I was in a rush to check-in—didn't want it to take hours to get to the accommodation place. On the way to exit it was obvious that the airport is very comfortable for a long wait.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0584.jpg'])

@ru
  <p>На данный момент работают терминалы 2 и 3.</p>
@en
  <p>As for now terminals 2 and 3 are operating.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0586.jpg'])

@ru
  <p>Метро всего две ветки. Составы ходят круглосуточно. Машинистов нет, то есть можно посмотреть на движение от первого лица. На видео можно заметить как лампы освещения чередуются с указателями аварийных выходов.</p>
@en
  <p>Metro has only two lines. It operates 24/7, thanks to its driverless nature. Lights interestingly interchange with emergency exit signs in the video below.</p>
@endru
<livewire:youtube title="Copenhagen Metro Front Row View" v="ssEFdyfSJGs"/>
@include('tpl.pic-2x', ['pic' => 'IMG_0588.jpg'])

@ru
  <p>Внутри состава.</p>
@en
  <p>Inside the metro car.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0589.jpg'])

@ru
  <p>Велопарковка у станции Нёррепорт ночью. Рядом макдак, который пришелся очень кстати, так как еды давно не было в поле зрения, а время уже за полночь. Далее диалог при покупке:</p>
  <ul class="list-dialog mb-4">
    <li>Дабл чизбургер, плиз</li>
    <li>Найнти (90) кронс</li>
  </ul>
  <p>Дал 100 и мысленно ошалел от такого расклада. Для перевода в рубли проще всего дописать ноль в конце суммы. Не может же чизбургер стоить 900 ₽, пусть и двойной! При выдаче сдачи на кассе загорелись числа 100 и 81. Найнтин! Он стоил 19 крон. Одна дополнительная буква в слове, а какое облегчение.</p>
@en
  <p>Bicycle parking at Nørreport station at night.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0590.jpg'])

@ru
  <p>Теперь включим свет.</p>
@en
  <p>Let's turn on the light now.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0882.jpg'])

@ru
  <p>Пар из-под земли.</p>
@en
  <p>Steam from under the ground.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0592.jpg'])

@ru
  <p>Сужение проезжей части у пешеходного перехода.</p>
@en
  <p>The roadway is narrowing right before the pedestrian cross.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0593.jpg'])

@ru
  <p>Уличная табличка.</p>
@en
  <p>Street sign.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0598.jpg'])

@ru
  <p>Выборгская улица. В Дании есть свой Выборг.</p>
@en
  <p>Viborg street. There is a city with the same name in Russia.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0608.jpg'])

@ru
  <p>Дворы.</p>
@en
  <p>Yards.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0599.jpg',
  'IMG_0601.jpg',
  'IMG_0603.jpg',
  'IMG_0611.jpg',
  'IMG_0612.jpg',
  'IMG_0848.jpg',
]])

@ru
  <p>Солнечные панели на крыше, закрывающей мусорки.</p>
@en
  <p>The solar panel is covering waste containers.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0600.jpg'])

@ru
  <p>Переход между зданиями.</p>
@en
  <p>Skyway.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0602.jpg'])

@ru
  <p>Еще один.</p>
@en
  <p>Another one.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0613.jpg'])

@ru
  <p>Уличные кафе.</p>
@en
  <p>Street cafes.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0605.jpg'])

<a id="pricy-meal"></a>
@ru
  <p>За двойной бутерброд с ветчиной и помидором + стаканом апельсинового сока в кафе зарядили 1&thinsp;500 ₽. Вот такая проба обеденного меню. Стало ясно, что дальше придется в этом городе <s>выживать</s> ходить в макдак, если не хочется остаться без штанов.</p>
@en
  <p>I asked myself "why do we so poor in Russia?" when I got a check. Yeah, the average salary is about 3&thinsp;000 DKK back home.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0607.jpg'])

@ru
  <p>Подъезд.</p>
@en
  <p>Stairwell.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0617.jpg'])

@ru
  <p>Паркомат. Blå zone — синяя зона.</p>
@en
  <p>Parking meter. Blå means blue.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0624.jpg'])

@ru
  <p>Отлично зарисовали глухие фасады.</p>
@en
  <p>Blind facades are nicely painted.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0628.jpg'])

@ru
  <p>Автомобильный номер.</p>
@en
  <p>License plate.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0636.jpg'])

<a id="tiny-elevator"></a>
@ru
  <p>Лифт.</p>
@en
  <p>Elevator.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0638.jpg'])

@ru
  <p>Электростанция.</p>
@en
  <p>Power station.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0640.jpg'])

@ru
  <p>Кран сбоку.</p>
@en
  <p>Crane from the side.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0641.jpg'])

@ru
  <p>Кран снизу.</p>
@en
  <p>Crane from below.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0642.jpg'])

@ru
  <p>Подзапущенная железная дорога.</p>
@en
  <p>Neglected railroad.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0643.jpg'])

@ru
  <p><a class="link" href="https://www.carrier.com/container-refrigeration/en/worldwide/products/Container-Units/PrimeLINE/">Система охлаждения</a> для контейнеров. Не спрашивайте как нашлась эта ссылка.</p>
@en
  <p><a class="link" href="https://www.carrier.com/container-refrigeration/en/worldwide/products/Container-Units/PrimeLINE/">The cooling system</a> of the container. Don't ask me how that link was found.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0647.jpg'])

@ru
  <p>Цепляем и поехали.</p>
@en
  <p>Let's hook it up and go.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0648.jpg'])

@ru
  <p>Только осторожно и не в воду, как этот автомобиль. Знакомый по книжкам с детства дорожный знак встретился впервые именно в Копенгагене.</p>
@en
  <p>But let's go carefully, not like this car. It reminds me of road signs from the books of my childhood.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0649.jpg'])

@ru
  <p>Препятствия, чтоб уж наверняка машины случайно не съехали в воду.</p>
@en
  <p>Barriers to prevent cars from falling down the water.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0651.jpg'])

@ru
  <p>Качели.</p>
@en
  <p>Swing.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0653.jpg'])

@ru
  <p>Закругленная форма опоры у знака. Совсем крохотные стрелки направления. Велодорожки размечены даже пустынном портовом районе. И люди действительно катаются.</p>
@en
  <p>The pipe goes around the sign at the top. Direction arrow is really tiny. Cycle lanes are marked even at deserted/industrial area near the port.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0654.jpg'])

@ru
  <p>Пример длинной стрелки под знаком.</p>
@en
  <p>Example of a long arrow.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0786.jpg'])

@ru
  <p>Парковка около порта.</p>
@en
  <p>Parking near the port.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0660.jpg'])

@ru
  <p>Парковка около дома.</p>
@en
  <p>Parking near the building.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0787.jpg'])

@ru
  <p>Парковка среди деревьев.</p>
@en
  <p>Parking among the trees.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0789.jpg'])

@ru
  <p>Уступать всем?</p>
@en
  <p>Give way to everyone?</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0662.jpg'])

@ru
  <p>Есть в этом кадре что-то от Титаника.</p>
@en
  <p>Something from Titanic is here in this shot.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0672.jpg'])

@ru
  <p>Сорока и солнечные панели.</p>
@en
  <p>Magpie and solar panels.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0674.jpg'])

@ru
  <p>Паром.</p>
@en
  <p>Ferry.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0676.jpg'])

@ru
  <p>Хитрой формы дом.</p>
@en
  <p>The building has unusual shapes.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0678.jpg'])

@ru
  <p>Двухэтажная велопарковка.</p>
@en
  <p>Double-decker bicycle parking.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0681.jpg'])

@ru
  <p>Навигация возле железнодорожной станции Эстерпорт и ее карта.</p>
@en
  <p>Østerport station navigation.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0682.jpg'])

@ru
  <p>Надземный переход к платформам.</p>
@en
  <p>Footbridge to the platforms.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0684.jpg'])

@ru
  <p>Велосипед можно перевезти в поезде.</p>
@en
  <p>You can take a bike on the train with you.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0695.jpg'])

@ru
  <p>Поезда справа не торопятся покидать станцию.</p>
@en
  <p>Trains to the right rarely leave the station.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0686.jpg'])

@ru
  <p>Слева же регулярно уходят.</p>
@en
  <p>In comparison, there is a lot of movement on the tracks to the left.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0690.jpg'])

@ru
  <p>Одна из платформ.</p>
@en
  <p>One of the platforms.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0688.jpg'])

@ru
  <p>Непросто синхронизироваться с дисплеем, чтобы были видны надписи.</p>
@en
  <p>Not so easy to sync with a display to take a picture of what's being displayed.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0693.jpg'])

@ru
  <p>Места 71–108 — налево, места 11–68 — направо.</p>
@en
  <p>Places 71–108 are to the left, 11–68 are to the right.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0700.jpg'])

@ru
  <p>Вагон словно в чехле.</p>
@en
  <p>Front of the car reminds a plunger.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0705.jpg'])

@ru
  <p>Разметка на дороге.</p>
@en
  <p>Lots of markup on the road.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0706.jpg'])

@ru
  <p>В супермаркете.</p>
@en
  <p>In the supermarket.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0708.jpg',
  'IMG_0709.jpg',
]])

@ru
  <p>Местные продукты отмечены флагом.</p>
@en
  <p>Local food has a Danish flag.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0707.jpg'])

@ru
  <p>Часто встречаются электронные ценники на товары. Не надо перепечатывать.</p>
@en
  <p>Electronic price tags are common. Fewer things to reprint.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0891.jpg'])

@ru
  <p><s>Опрыскивание</s> Увлажнение фруктов.</p>
@en
  <p>Misting system helps fruits to reach the proper level of humidity.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0892.jpg'])

@ru
  <p>В данном случае яблок.</p>
@en
  <p>It helps apples in this case.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0893.jpg'])

<a id="netto"></a>
@ru
  <p>Товары перед супермаркетом. Оплачивать внутри.</p>
@en
  <p>Goods are in front of the supermarket. Pay inside.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0895.jpg'])

@ru
  <p>Стоимость чешского пива в баре. Объем неизвестен. К цене по-прежнему приписываем ноль в конце для суммы в рублях.</p>
@en
  <p>Price list of Czech beer. Mostly it's 10 USD per bottle. I'm curious if it's 330 ml or 500 ml.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0949.jpg'])

@ru
  <p>Уличная навигация.</p>
@en
  <p>Street navigation.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0713.jpg'])

@ru
  <p>Улицы. После <a class="link" href="berlin.2017.05">Берлина</a> бросается в глаза малое количество деревьев.</p>
@en
  <p>Streets of Copenhagen. A paucity of trees is conspicuous after <a class="link" href="berlin.2017.05">Berlin</a>.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0591.jpg',
  'IMG_0594.jpg',
  'IMG_0597.jpg',
  'IMG_0606.jpg',
  'IMG_0609.jpg',
  'IMG_0616.jpg',
  'IMG_0627.jpg',
  'IMG_0711.jpg',
  'IMG_0785.jpg',
  'IMG_0796.jpg',
  'IMG_0803.jpg',
  'IMG_0830.jpg',
  'IMG_0832.jpg',
  'IMG_0835.jpg',
  'IMG_0839.jpg',
  'IMG_0859.jpg',
  'IMG_0861.jpg',
  'IMG_0866.jpg',
  'IMG_0869.jpg',
  'IMG_0874.jpg',
  'IMG_0908.jpg',
  'IMG_0910.jpg',
  'IMG_0911.jpg',
  'IMG_0913.jpg',
  'IMG_0941.jpg',
  'IMG_0953.jpg',
  'IMG_0957.jpg',
  'IMG_0987.jpg',
  'IMG_0994.jpg',
]])

@ru
  <p>Парк и окрестности крепости. На возвышенностях был достаточно сильный ветер, но он не переносил потоки пыли и песка, поэтому был кайф ловить лицом чистый воздух, а не щуриться и отворачиваться, как дома.</p>
@en
  <p>Park and surroundings of a fortress. It was quite windy up there, but wind didn't carry dust and sand as in dirty Russia, so it was a pleasure to feel its flow with a face and not to squint and turn my back to it.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0716.jpg',
  'IMG_0718.jpg',
  'IMG_0720.jpg',
  'IMG_0725.jpg',
  'IMG_0727.jpg',
  'IMG_0728.jpg',
  'IMG_0732.jpg',
  'IMG_0735.jpg',
  'IMG_0751.jpg',
]])

@ru
  <p>Удобства для застолья на улице.</p>
@en
  <p>Picnic setting in a park.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0723.jpg'])

@ru
  <p>Тесла в парке.</p>
@en
  <p>Tesla in a park.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0724.jpg'])

@ru
  <p>Пешеходный переход.</p>
@en
  <p>Pedestrian cross.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0752.jpg'])

@ru
  <p>Пополнение коллекции флагов.</p>
@en
  <p>Expanding the flags collection.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0760.jpg'])

@ru
  <p>С лебедем выбрались на фотосессию.</p>
@en
  <p>Went out with a swan to do a photo shoot. The last pic is my favorite one.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0763.jpg',
  'IMG_0764.jpg',
  'IMG_0766.jpg',
  'IMG_0772.jpg',
  'IMG_0777.jpg',
]])

@ru
  <p>Пирс.</p>
@en
  <p>Pier.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0779.jpg'])

@ru
  <p>Электромобили на подзарядке.</p>
@en
  <p>Electric cars are charging.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0782.jpg'])

@ru
  <p>Фонтан сбоку.</p>
@en
  <p>Side view of the fountain.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0792.jpg'])

@ru
  <p>Фонтан спереди.</p>
@en
  <p>Front view.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0794.jpg'])

@ru
  <p>Физическая разметка парковочных мест.</p>
@en
  <p>Physical parking markup.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0801.jpg'])

@ru
  <p>Каналы и пролив Эресунн.</p>
@en
  <p>Canals and Øresund strait.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0634.jpg',
  'IMG_0635.jpg',
  'IMG_0804.jpg',
  'IMG_0805.jpg',
  'IMG_0802.jpg',
  'IMG_0812.jpg',
  'IMG_0816.jpg',
  'IMG_0818.jpg',
  'IMG_0819.jpg',
  'IMG_0828.jpg',
  'IMG_0833.jpg',
  'IMG_0837.jpg',
  'IMG_0844.jpg',
  'IMG_0853.jpg',
]])

@ru
  <p>Фасады.</p>
@en
  <p>Facades.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0614.jpg',
  'IMG_0806.jpg',
  'IMG_0841.jpg',
]])

@ru
  <p>Мост через пролив. Просьба остановиться, когда мигает лампочка.</p>
@en
  <p>Bridge across the strait. Please stop when the light bulb is blinking.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0809.jpg'])

@ru
  <p>Даже на мосту есть разделение на пешеходную часть и велодорожку.</p>
@en
  <p>Ways for pedestrians and cyclists are separated even on a bridge.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0815.jpg'])

@ru
  <p>На другом мосту разделение потоков более основательное.</p>
@en
  <p>Thorough separation of ways on the next bridge.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0820.jpg'])

@ru
  <p>Подзарядка для суден.</p>
@en
  <p>Charger for boats.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0822.jpg'])

@ru
  <p>Соседней активно пользуются.</p>
@en
  <p>The next one is actively being used.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0823.jpg'])

@ru
  <p>Дождя нет, зонтики можно свернуть.</p>
@en
  <p>There is no rain, so umbrellas can be folded.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0825.jpg'])

@ru
  <p>Детский велосипед привязан к столбу.</p>
@en
  <p>Locked child bicycle.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0834.jpg'])

@ru
  <p>Вышка перед домом.</p>
@en
  <p>Aerial work platform.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0846.jpg'])

@ru
  <p>Дороги.</p>
@en
  <p>Roads.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0655.jpg',
  'IMG_0656.jpg',
  'IMG_0665.jpg',
  'IMG_0679.jpg',
  'IMG_0783.jpg',
  'IMG_0855.jpg',
  'IMG_0856.jpg',
  'IMG_0858.jpg',
  'IMG_1098.jpg',
  'IMG_1096.jpg',
  'IMG_1104.jpg',
]])

@ru
  <p>Плитка на площади.</p>
@en
  <p>Paving at a square.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0864.jpg'])

@ru
  <p>Почтовый ящик.</p>
@en
  <p>Postbox.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0871.jpg'])

@ru
  <p>Старый автобус.</p>
@en
  <p>Old bus.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0875.jpg'])

@ru
  <p>Фонтан по нраву собаке.</p>
@en
  <p>The dog really likes the fountain.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0880.jpg'])

@ru
  <p>Ступеньки и площадь по нраву людям.</p>
@en
  <p>People really like stairs and the square.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0881.jpg'])

@ru
  <p>Бензин около 100 ₽ за литр.</p>
@en
  <p>Gas is around 1.6 USD per liter.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0889.jpg'])

@ru
  <p>Автобусная остановка. Здесь у автобусов выделенные полосы.</p>
@en
  <p>Bus stop. Buses have dedicated lanes.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0894.jpg'])

@ru
  <p>«Время отправления неизвестно, всего хорошего» — говорит нам табло на остановке.</p>
@en
  <p>No departure times for you, have a pleasant journey.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0904.jpg'])

@ru
  <p>Работающее табло.</p>
@en
  <p>This display works.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0883.jpg'])

@ru
  <p>Часть проезжей части перекрыли для ремонта. Но по ней проходит велодорожка. Перекрытием дело не закончилось — еще поставили знак велосипедистам заезжать на тротуар и продолжать движение по нему вдоль ремонтируемого участка. Особого внимания заслуживает прилегающий к бордюру кусок асфальта, чтобы среда оставалась безбарьерной. Ведь по велодорожкам ездят не только на велосипедисты, но и инвалиды. Разумеется, в конце огражденного участка сделан такой же заботливый съезд обратно.</p>
@en
  <p>Part of the cycle lane is closed for some repair work. But it's not the end of the story, because there is also a road sign here asking cyclists to shift to the sidewalk. Well, that's not the thing you probably gonna see in Russia. Alright, we don't have many cycle lanes too. But a really wonderful thing here is a tiny piece of asphalt, connecting the cycle lane with the sidewalk, so it's still a barrier-free environment. Such care! We are many steps behind indeed.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0906.jpg'])

@ru
  <p>Что характерного есть в Копенгагене? Кирпичи.</p>
@en
  <p>What is one of the main attributes of Copenhagen? Bricks.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0909.jpg',
  'IMG_0972.jpg',
  'IMG_0975.jpg',
]])

@ru
  <p>И велосипеды. Много велосипедов. Около 40% населения страны на них передвигается.</p>
@en
  <p>And bicycles. Lots of bicycles. Lots of like 40% of the population of Denmark uses them.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0610.jpg',
  'IMG_0620.jpg',
  'IMG_0710.jpg',
  'IMG_0808.jpg',
  'IMG_0826.jpg',
  'IMG_0857.jpg',
  'IMG_0862.jpg',
  'IMG_0914.jpg',
]])

@ru
  <p>Кирпичи и велосипеды.</p>
@en
  <p>Bricks and bicycles.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0974.jpg'])

@ru
  <p>Расстояние и время в пути до районов для велосипедистов.</p>
@en
  <p>Distance and time to get to some places for cyclists.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0920.jpg'])

@ru
  <p>Приятное граффити. Неприятный подземный переход.</p>
@en
  <p>Beautiful graffiti. Not beautiful underpass.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0918.jpg'])

@ru
  <p>Парк? Нет, кладбище. Но используется как парк: люди отдыхают, устраивают пикники, загорают и просто гуляют. А что, так можно было?</p>
@en
  <p>Park? No, cemetery. But it's used as a park: people rest, go on a picnic, sunbathe or just stroll. Wait, what? Was it possible to use it this way?</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0922.jpg',
  'IMG_0923.jpg',
  'IMG_0924.jpg',
  'IMG_0928.jpg',
  'IMG_0930.jpg',
  'IMG_0931.jpg',
  'IMG_0933.jpg',
  'IMG_0937.jpg',
  'IMG_0938.jpg',
  'IMG_0939.jpg',
  'IMG_0940.jpg',
]])

@ru
  <p>Подземный переход закрыли. Ура! Знак еще можно убрать.</p>
@en
  <p>The underpass is closed. Yay! Its road sign is redundant now.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0942.jpg'])

@ru
  <p>Табличка с названием улицы.</p>
@en
  <p>Street sign.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0948.jpg'])

@ru
  <p>Люк.</p>
@en
  <p>Manhole.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0950.jpg'])

@ru
  <p>Балконы.</p>
@en
  <p>Balconies.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0951.jpg'])

@ru
  <p>Домофон.</p>
@en
  <p>Intercom.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0955.jpg'])

@ru
  <p>Такса — такси.</p>
@en
  <p>Taxa means taxi.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0956.jpg'])

@ru
  <p>Где-то неподалеку метро.</p>
@en
  <p>Metro is nearby.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0960.jpg'])

@ru
  <p>На автобусе написаны остановки.</p>
@en
  <p>Stops are written on a bus.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0962.jpg'])

@ru
  <p>Все уличные столы и стулья опутаны во внерабочее время.</p>
@en
  <p>Outside tables and seats are chained.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0963.jpg'])

@ru
  <p>Лифт на станцию Фредериксберг.</p>
@en
  <p>Frederiksberg station elevator.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0964.jpg'])

@ru
  <p>Места для прогулок.</p>
@en
  <p>Places for a walk.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0791.jpg',
  'IMG_0797.jpg',
  'IMG_0798.jpg',
  'IMG_0799.jpg',
  'IMG_0800.jpg',
  'IMG_0836.jpg',
  'IMG_0966.jpg',
  'IMG_0968.jpg',
  'IMG_0969.jpg',
  'IMG_0970.jpg',
  'IMG_0971.jpg',
  'IMG_0877.jpg',
  'IMG_0976.jpg',
  'IMG_0978.jpg',
  'IMG_0981.jpg',
  'IMG_0984.jpg',
  'IMG_0985.jpg',
  'IMG_0986.jpg',
]])

@ru
  <p>Лабиринт.</p>
@en
  <p>Maze.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0993.jpg'])

@ru
  <p>Вход во двор дома.</p>
@en
  <p>Entrance to the yard of the house.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0995.jpg'])

@ru
  <p>Дом с бассейном.</p>
@en
  <p>House with a pool.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0999.jpg'])

@ru
  <p>Тень от забора.</p>
@en
  <p>Fence's shadow.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1001.jpg'])

@ru
  <p>Уличное кафе.</p>
@en
  <p>Street cafe.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1002.jpg'])

@ru
  <p>Над проезжей частью лампы для подсветки, как в <a class="link" href="spb.2016.03#lamps">Санкт-Петербурге</a>.</p>
@en
  <p>Lamps above the road, as in <a class="link" href="spb.2016.03#lamps">Saint Petersburg</a>.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1003.jpg'])

@ru
  <p>Часто практикуется продавать два товара вместе немного дешевле, чем раздельно.</p>
@en
  <p>Two or three things together can often be bought slightly cheaper, than separately.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1005.jpg'])

@ru
  <p>Картошки тоже касается.</p>
@en
  <p>It also applies to chips.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1004.jpg'])

@ru
  <p>Велосипеды здесь не паркуем, проезжаем дальше.</p>
@en
  <p>Don't park a bicycle here, move further.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1006.jpg'])

@ru
  <p>Терминал для транспортной карты <a class="link" href="https://www.rejsekort.dk">Rejsekort</a>. Можно посмотреть историю поездок и баланс, пополнить карту, а также сделать чек-ин и чек-аут.</p>
@en
  <p>Terminal for <a class="link" href="https://www.rejsekort.dk">Rejsekort</a> transport card. You can check here its balance, the history of your journeys, charge it, do check-in and check-out.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0703.jpg'])

@ru
  <p>С другой стороны автомат по продаже обычных бумажных билетов.</p>
@en
  <p>There is a paper ticket terminal on the other side—two terminals are back to back.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0704.jpg'])

@ru
  <p>Метро.</p>
@en
  <p>Metro.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_1007.jpg',
  'IMG_1010.jpg',
  'IMG_1011.jpg',
]])

@ru
  <p>При наличии транспортной карты надо делать чек-ин и чек-аут у подобных терминалов. Карты бывают персональные (для местных) и обезличенные. Проезд по карте вдвое дешевле одноразовых билетов, но у ее обезличенного варианта высокая минимальная сумма пополнения, поэтому туристам она едва ли выгодна. Так что будьте добры готовить минимум 24 кроны (≈240 ₽) на одну поездку.</p>
@en
  <p>Gates to check-in and check-out with Rejsekort card at the metro station. The card can be personal (for locals) or anonymous. Single ride with a card is half the price of a paper ticket. Huge deal? Not for tourists. You have to charge an anonymous card with a lot of money in order to start using it. So forget it and get ready to pay 24 DKK for each ticket.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1016.jpg'])

@ru
  <p>Бумажный билет можно купить в терминалах на станциях метро и у водителя автобуса за наличные. Вход в автобус только через переднюю дверь. Минимум нужно оплатить две зоны. Для поездки из центра в аэропорт и наоборот понадобится билет на три зоны. Ездить и делать пересадки можно около полутора часов, дальше понадобится новый билет. В автобусе сдачу с покупки выдает автомат, нужно самому открывать отсек и забирать монеты.</p>
@en
  <p>Ticket can be bought from the terminal at the stations or from a bus driver. Entrance to the bus is only through its front door. At least two zones ticket has to be bought. You need three zones ticket to get to/from the airport. Ticket is valid for about 90 minutes, there are unlimited transfers within this period. You have to collect the change from the machine by yourself when you pay to the driver with cash.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1013.jpg'])

@ru
  <p>Красный цвет и буква А у маршрута 8А означают, что он проложен по самому центру и ходит наиболее часто. Во время посадки и высадки пассажиры перекрывают велодорожку.</p>
@en
  <p>Route 8A has red color and A letter. It means that it has a very short interval and goes through the heart of Copenhagen. In other words, it's central. People usually stop bicycle traffic while boarding and disembarking.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0596.jpg'])

@ru
  <p>Оранжевый цвет для обычных маршрутов.</p>
@en
  <p>The orange color is for regular—less central—routes. Interval is also longer.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0659.jpg'])

@ru
  <p>Синий цвет и буква S для маршрутов с меньшим количеством остановок. Еще бывает серый цвет и буква N для ночных маршрутов.</p>
@en
  <p>Blue color and S letter are for routes with fewer stops. There are also gray color and N letter for night routes.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0854.jpg'])

@ru
  <p>В какое время ходит маршрут 27 понятно, но где еще он останавливается — нет. Есть к чему стремиться транспортникам.</p>
@en
  <p>I understand what time bus route 27 goes, but I have no clue where are its stops. There is a room for improvement.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0637.jpg'])

@ru
  <p>В автобусе надо жать стоп, иначе водитель пропускает остановки. Поручень неожиданно расположился между сидениями.</p>
@en
  <p>Driver could skip a stop if you don't press the stop button. It's unusual to see a handrail between the seats.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1185.jpg'])

@ru
  <p>На экране в салоне показывается маршрут, транспортная зона и следующая остановка. Вместе с рекламой чередуется расписание транспорта будущих остановок для удобства осуществления пересадок.</p>
@en
  <p>There is a route number on the screen, fare zone, and the next stop. Advertisement takes turns with the schedule of the future stops, which makes transfers more convenient.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1188.jpg'])

@ru
  <p>Может забить и не платить? Товарищи вроде этого лысого дядьки регулярно проверяют билеты. За четыре поездки на метро наличие билета у меня проверили трижды. Для сравнения — в <a class="link" href="countries/czech-republic">Чехии</a> не проверили ни разу за 3 визита в страну.</p>
@en
  <p>What about going without a ticket? Folks like this one won't like it. I was checked three times during four rides on the metro. By the way, I was checked zero times in <a class="link" href="countries/czech-republic">Czechia</a> during my all 3 trips.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1179.jpg'])

@ru
  <p>Лифт на станции метро Эресунн.</p>
@en
  <p>Elevator at the Øresund station.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1021.jpg'])

@ru
  <p>Рядом с этой станцией шикарное место для прогулок и спорта. По счастливому стечению обстоятельств время шло к закату.</p>
@en
  <p>There is a nice place for a walk and sports near this station. Lucky for me it was going to sunset.</p>
@endru
<livewire:youtube title="Copenhagen Øresund Embankment" v="wwU1r74TJw8"/>
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_1023.jpg',
  'IMG_1026.jpg',
  'IMG_1035.jpg',
  'IMG_1038.jpg',
  'IMG_1039.jpg',
  'IMG_1041.jpg',
  'IMG_1069.jpg',
  'IMG_1074.jpg',
  'IMG_1086.jpg',
  'IMG_1090.jpg',
  'IMG_1091.jpg',
  'IMG_1097.jpg',
]])

@ru
  <p>Датский алфавит.</p>
@en
  <p>Danish alphabet.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1067.jpg'])

@ru
  <p>Снимок задумывался без машины, как мост в никуда. Но благодаря ей и особенно включенным фарам снимок стал более зловещим.</p>
@en
  <p>There was an idea of a shot without a car, like a path to nowhere, like Lost Highway. It turned out to be more interesting with a car and its headlight. More creepy.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1100.jpg'])

@ru
  <p>Домик. Кстати, вода из-под крана в жилых домах питьевая.</p>
@en
  <p>House. By the way, tap water is safe to drink.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1105.jpg'])

@ru
  <p>Вход на станцию метро Фемёрен.</p>
@en
  <p>Entrance to the Femøren metro station.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1109.jpg'])

@ru
  <p>Наверху красота.</p>
@en
  <p>It's a beauty up here.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1111.jpg'])

@ru
  <p>Станции небольшие, как и составы поездов.</p>
@en
  <p>Stations are short, so as trains.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1118.jpg'])

@ru
  <p>На снимке в Википедии на этой станции первое время не было ограждений. Теперь есть.</p>
@en
  <p>I came across a photo of this station on the internet. There was no guard rail here years back. Now there is.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1120.jpg'])

@ru
  <p>Ограждения открываются одновременно с дверьми поезда.</p>
@en
  <p>Station's and the train's doors are opened simultaneously.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1121.jpg'])

@ru
  <p>Машинистов действительно нет — спереди пассажиры. Интересно ощущать как состав поддает газу во время движения. Невольно возникают вопросы: «Как поезд понимает с какой скоростью ему ехать? Эталонно человек проехался? Подкручивают параметры на ходу?». Скорее всего подкручивают, а то и как-то управляют удаленно, ведь интервал движения в разное время суток разный, проводится обслуживание рельс, плюс всегда возможны аварии и прочие ситуации, ведущие к задержкам движения.</p>
@en
  <p>There are no drivers indeed. There are passengers in the front row. It's interesting to feel how the train accelerates. You ask yourself "why does it keep this particular speed here? Does it just do what man did before? Like following a standard? Does it adjust to what happens around?" Most likely it does adjust because the interval is different throughout a day. There should be remote control as well because there might be failures and emergencies—therefore delays.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1176.jpg'])

@ru
  <p>До поездки стоял вопрос где и сколько крон закупить, чтобы хватило на мелкие расходы на месте. На удивление банк ВТБ выручил и в этот раз — японские йены в Калуге у них тоже были. Оставалось решить сколько брать крон. Посчитал, что двести будет достаточно. В кассе банка мой выбор встретили недоуменным взглядом. Еще бы! Это словно 200 рублей пойти снять со счета.</p>
@en
  <p>Before the trip, I thought how much DKK I need to have for small purchases. The bank across the street from my home rescued me once again—it had Japanese yens earlier this year as well. So the question remained "how much to buy?" Well, I assumed 200 DKK would be enough. If you could only see how the cashier looked at me. Yeah! It was like withdrawal or 200 RUB—barely enough money for a lunch in Russia.</p>
@endru

@ru
  <p>Одна, две и сто датских крон. Это то, что вернулось домой из тех двухсот. Без налички в Копенгагене выжить без проблем.</p>
@en
  <p>One, two and a hundred DKK. These got home with me, actually. No need to have much cash in Copenhagen.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1195.jpg'])

@ru
  <p>Они же с обратной стороны.</p>
@en
  <p>Backside.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1194.jpg'])

@ru
  <p>Приезжать в аэропорт впритык? Это я умею. В этот раз выехал из дома за 80 минут до международного рейса, приехал за 40. Автоматизированное метро позволяет быть уверенным в оценке времени в пути.</p>
@en
  <p>Get to the airport just in time, not in advance? Yeah, that's what I like to do. Left accommodation 80 minutes before the flight, got to the airport in 40 minutes. Automatic metro works like clockwork.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1201.jpg'])

@ru
  <p>В качестве эксперимента был выбран европейский лоукостер РайанЭйр. Россиян (если точнее — неевропейцев) они требуют пройти процедуру проверки визы на стойке регистрации. Обычно регистрация заканчивается за 40 минут до вылета, но тут всего лишь проверка и печать на листе, думал я. Впрочем, так и оказалось. Во время получения штампа до вылета оставалось менее 35 минут. Выход на посадку был в самом дальнем углу аэропорта, идти до него минут 15–20. Впрочем, посадка только начиналась, когда я добрался до точки назначения.</p>
@en
  <p>So it was my first flight with RyanAir. Non-European citizen needs to do a visa check at the check-in desk. Usually, desks close 40 minutes before the flight. I thought it's just a check and a stamp on the paper sheet, so no worries. Well, it really was that simple. 35 minutes to go. Gate was the farthest, like 15–20 minutes walk. Boarding had just started when I got there.</p>
@endru

<a id="no-bus"></a>
@ru
  <p>Отличный способ понять как много услуг включено в стоимость авиабилета, когда пробуешь лететь без них. Например, не было даже автобуса до самолета — шли пешком из терминала по аэродрому.</p>
@en
  <p>Great way to understand how many services usual ticket includes is to try to fly without them. There was no bus to take us to the plane—we made our own way on feet from gate F1.</p>
@endru

@ru
  <p>Если вам как-то удалось пронести большую ручную кладь до самолета, то на подходе к нему ее могут отжать в бесплатный багаж — тем самым бортпроводники со специальной тележкой для транспортировки пытаются разгрузить переполненные полки самолета.</p>
@en
  <p>If you carry a lot of hand luggage you might be asked by a staff to take your belongings to the luggage compartment in order to reduce the load on the overhead shelves inside the plane.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1197.jpg'])

@ru
  <p>У кресел ни намека на возможность откидывания, карманов тоже нет. Инструкция по безопасности вклеена в спинку. Еда и вода за деньги. Выбор места тоже, как регистрация в аэропорту.</p>
@en
  <p>No way to lean back in these chairs. No seat pockets as well. Safety instruction is pasted in the seat in front of you. Paid food and water. Seat selection is paid too, as well as check-in at the airport.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1203.jpg'])

@ru
  <p>Но зачем все эти услуги, когда лететь меньше часа? Первые минут пять даже сотовая связь не пропадала. Копенгаген слева.</p>
@en
  <p>But why do you need all these services when the whole flight takes less than an hour? There even was a cellular connection for the first five minutes of the flight. Copenhagen is to the left.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1207.jpg'])

@ru
  <p>Мост между Данией и Швецией (город Мальмё).</p>
@en
  <p>The bridge between Denmark and Sweden (the city is called Malmö).</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1211.jpg'])

@ru
  <p>Пролетаем над Швецией. До взлета была проблема с распределением веса в самолете — хвост перевешивал. Конечно, туда ведь автоматически сажает система, если не платить за выбор места. Бортпроводники попросили бесплатно пересесть к носу — до 12 ряда.</p>
@en
  <p>Flying over Sweden. There was a weight distribution problem inside the plane, the rear half was overweight. Yeah, that's where you end up if you don't pay for the seat selection. We were asked by the cabin crew to take any seat in the first twelve rows.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1213.jpg'])

@ru
  <p>Среди персонала на борту не было ни одной женщины.</p>
@en
  <p>There was not a single woman among flight attendants.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1217.jpg'])

@ru
  <p>А ребята бортпроводники оказались большие шутники: «Добро пожаловать на рейс до Китая. За штурвалом у нас сегодня Криштиану Роналду. Его ассистент Лионель Месси. Среди особых гостей на борту есть такой такой-то».
@en
  <p>As for guys of the cabin crew, they were funny. "Welcome aboard to the flight to China. Today our captain is Cristiano Ronaldo. His assistant is Lionel Messi. There is [some famous name here] among the passengers."</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1219.jpg'])
@endsection

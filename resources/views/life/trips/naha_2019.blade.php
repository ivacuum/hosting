@extends('life.trips.base')

@section('content')
@ru
  <p>Впервые столкнулся с тем, что рейс не только неоднократно перенесли, но и перенесли на более раннее время. В первоначальной июльской маршрутной квитанции прибытие в 08:35 и далее самолет до острова Окинава в 12:25. 5 августа приходит уведомление, что пересадка становится короче, потому что самолет отправится в 12:00. 22 августа отправление переносят уже на 11:45. Это всего 3 часа и 10 минут на пересадку расстоянием 80 км на автобусе или порядка 100 км на поездах.</p>
@endru

@ru
  <p>В автобус не было веры из-за неизвестности в плане пробок и наличия билетов, а надежные и пунктуальные поезда уже были опробованы в прошлые поездки. Поездом время в пути выходило примерно 1 час 45 минут. В багаж было решено ничего не сдавать, чтобы повысить шансы успеть на пересадку. Если прилететь в Нариту вовремя и пройти границу за 15 минут, то прибыть в аэропорт Ханеда получится за 1 час 6 минут до вылета в Окинаву. Если этот поезд пропустить, то следующая связка доставит в Ханеду за 45 минут до вылета. Остальные поезда приходят слишком поздно. Поехать на такси — это отдать порядка 40000 иен, сопоставимых со стоимостью перелета Москва–Нарита — лучше, чем не успеть на рейс, но нежелательно прибегать к этому варианту.</p>
@endru

@ru
  <p>Что ж, на железнодорожной платформе случается непредвиденная ошибка — путаю платформы, нужный поезд уходит прямо на глазах. Немая пауза. Счет идет на минуты — надо найти как ехать, так как самолет ждать не будет. Прыгнув в следующую электричку той же ветки, прямо в пути подыскивается решение. От текущей геолокации подходящий маршрут не построить, так как навигатор не знает, что ты в поезде, поэтому предлагает двигаться ценные 15 минут до ближайшей станции, а оттуда уже на поезде. Как быть? Можно построить маршрут от одной из будущих станций, тогда остаток маршрута будет подходящий. Как найти маршрут поезда, который ушел? Можно построить маршрут на необходимое время на завтра, указав время на 5–10 минут меньше, чем сейчас на часах. Подобная смекалка в стрессовых условиях как-то вывела на решение на какой поезд и где пересесть, чтобы дальше следовать намеченным первоначальным маршрутом.</p>
@endru

@ru
  <p>Прибыть в аэропорт удалось чуть ли не за полчаса до вылета. Но надо же еще пройти предполетный досмотр и найти нужный выход на посадку. Благо электронная регистрация на рейс уже была пройдена и багаж отсутствовал. Приходится бегать с чемоданом и просить людей пропустить без очереди. Минут за пятнадцать до вылета удается найти самолет — оказалось, что посадка в него только началась, а вылет задержан минут на пятнадцать.</p>
@endru

@ru
  <p>Ровное крыло самолета японских авиалиний.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2559.jpg'])

@ru
  <p>На внутреннем перелете Ханеда–Наха был такой же большой боинг 787, что летает между Россией и Японией, только компоновка кресел с предпочтением экономическому классу, чтобы больше пассажиров уместилось на непродолжительный полет. Посадка получилась самая стремная из испытанных. Нелюбовь к воде и страх высоты слились воедино с диким ветром. Было ощущение, что от тряски над океаном ноги вот-вот окажутся за головой.</p>
@endru

@ru
  <p>Аэропорт в Нахе.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2561.jpg'])

@ru
  <p>Цветы в аэропорту.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2562.jpg'])

@ru
  <p>Самолет раскрашен в горошек.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2563.jpg',
  'IMG_2564.jpg',
]])

@ru
  <p>Автобусы на парковке.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2565.jpg'])

@ru
  <p>На Окинаве своя транспортная карта OKICA. Карты с основного острова страны не действуют.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2566.jpg'])

@ru
  <p>Монорельс.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2567.jpg'])

@ru
  <p>Монорельс подбросил в центр столицы, где бушует ливень.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2568.jpg'])

@ru
  <p>Пейзажи тихоокеанского острова.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2569.jpg',
  'IMG_2571.jpg',
]])

@ru
  <p>Зарастающая лестница.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2570.jpg'])

@ru
  <p>Стоит смотреть под ноги, а то можно угодить в воду.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2572.jpg'])

@ru
  <p>Деревянные скамейки вокруг дерева.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2573.jpg'])

@ru
  <p>Пляж и океан. Облачная погода защитила от обгорания.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2577.jpg'])

@ru
  <p>Радующий виноградный напиток из автомата.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2581.jpg'])

@ru
  <p>Улица и врата.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2582.jpg'])

@ru
  <p>Фонтан. Далее за сеткой поле для отработки ударов гольфистами.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2584.jpg'])

@ru
  <p>Парковка с травой. Рядом скамейки со столиками.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2585.jpg'])

@ru
  <p>Уклон, чтобы мячики для гольфа возвращались.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2586.jpg'])

@ru
  <p>Статуэтка у жилого дома.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2587.jpg'])

@ru
  <p>Кактус на улице возле дороги.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2588.jpg'])

@ru
  <p>Вывеска на английском и японском.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2591.jpg'])

@ru
  <p>Улицы с пальмами.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2592.jpg',
  'IMG_2593.jpg',
]])

@ru
  <p>Зубные щетки продаются с зубной пастой.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2594.jpg'])

@ru
  <p>Многоуровневое здание.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2608.jpg'])

@ru
  <p>Полицейский участок зовется кобаном.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2609.jpg'])

@ru
  <p>Фонтан.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2610.jpg'])

@ru
  <p>Каменные пеньки возле дерева.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2622.jpg'])

@ru
  <p>Питьевой фонтанчик.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2623.jpg'])

@ru
  <p>Фигурки на продажу.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2635.jpg'])

@ru
  <p>Просьба не лазать наверх.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2636.jpg'])

@ru
  <p>Змеи на дне напитка.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2637.jpg'])

@ru
  <p>Шлепки в форме рыб.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2638.jpg'])

@ru
  <p>Собак привлекла витрина с одеждой.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2639.jpg'])

@ru
  <p>Ступеньки на стене.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2654.jpg'])

@ru
  <p>Вода с пузырьками в стеклянной стенке.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2659.jpg'])

@ru
  <p>Темнеет, загораются вывески.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2662.jpg'])

@ru
  <p>Загорается подсветка.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2663.jpg'])

@ru
  <p>Включилась иллюминация.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2674.jpg',
  'IMG_2675.jpg',
]])

@ru
  <p>В магазине корзинки для взрослых.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2676.jpg'])

@ru
  <p>И корзинки для детей.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2677.jpg'])

@ru
  <p>Тротуар на мосту.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2678.jpg'])

@ru
  <p>Место практики дайверов. Камень в форме черепашки удерживает столбик.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2680.jpg',
  'IMG_2679.jpg',
]])

@ru
  <p>Беседка на берегу океана.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2681.jpg'])

@ru
  <p>Ресторанные веранды простаивают в ноябре.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2689.jpg'])

@ru
  <p>Под мостом.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2745.jpg'])

@ru
  <p>Вход в заведение общепита.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2762.jpg'])

@ru
  <p>Сегодня в меню.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2763.jpg'])

@ru
  <p>Вид из-за столика.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2764.jpg'])

@ru
  <p>Вход в здание зарос.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2770.jpg'])

@ru
  <p>Лоджии и кондиционеры на них.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2771.jpg'])

@ru
  <p>Что-то растет на деревьях. Горох?</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2772.jpg'])

@ru
  <p>Река идет сквозь город.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2773.jpg'])

@ru
  <p>Зеркало на выезде из гаража на улицу.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2774.jpg'])

@ru
  <p>Цветы в горшочках.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2775.jpg'])

@ru
  <p>Канализационный люк.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2776.jpg'])

@ru
  <p>Рукописное объявление на полу.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2778.jpg'])

@ru
  <p>Заградительные столбики с лентой подсветки.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2779.jpg'])

@ru
  <p>Пляжный футбол.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2780.jpg'])

@ru
  <p>Пирс.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2782.jpg'])

@ru
  <p>Пляж.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2783.jpg',
  'IMG_2784.jpg',
  'IMG_2791.jpg',
]])

@ru
  <p>Небольшой колодец на берегу.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2786.jpg'])

@ru
  <p>Набережная.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2801.jpg',
  'IMG_2802.jpg',
  'IMG_2803.jpg',
]])

@ru
  <p>Дроны запрещены.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2804.jpg'])

@ru
  <p>Широкий умывальник в уличном туалете.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2805.jpg'])

@ru
  <p>Снова ливень. Летние веранды временно неактуальны.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2807.jpg'])

@ru
  <p>Четыре скамейки квадратом в торговом центре.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2808.jpg'])

@ru
  <p>Пальмы в городе.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2830.jpg'])

@ru
  <p>Деревья отцветают.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2831.jpg',
  'IMG_2832.jpg',
]])

@ru
  <p>Каменные пеньки возле парка.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2858.jpg'])

@ru
  <p>Спуск к уличному туалету.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2859.jpg'])

@ru
  <p>Улицы.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2866.jpg',
  'IMG_2867.jpg',
]])

@ru
  <p>Автобусные туры одним днем по острову Окинава. Выбрана поездка в океанариум.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2868.jpg'])

@ru
  <p>Гид в автобусе говорит только на японском, иностранцам предлагается текстовый вариант экскурсии.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2869.jpg'])

@ru
  <p>В путь по острову. Переворачиваемые бумажные часы использовали для напоминания времени отправления со стоянок.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2873.jpg'])

@ru
  <p>И тут дронам не рады.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2874.jpg'])

@ru
  <p>Мыс.</p>
@en
  <p>Cape.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2877.jpg',
  'IMG_2891.jpg',
]])

@ru
  <p>Гавань.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2894.jpg',
  'IMG_2896.jpg',
]])

@ru
  <p>Скамейки.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2895.jpg'])

@ru
  <p>Зарезервированный столик.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2905.jpg'])

@ru
  <p>Зал отеля, в который привезли на обед.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2906.jpg'])

@ru
  <p>Вид от въезда в отель.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2907.jpg',
  'IMG_2908.jpg',
]])

@ru
  <p>Автомобили слева, пешеходы справа.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2909.jpg'])

@ru
  <p>В океанариум приезжают семьями.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2910.jpg'])

@ru
  <p>Виднеется соседний остров.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2911.jpg'])

@ru
  <p>Экспозиции с животными.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2912.jpg',
  'IMG_2913.jpg',
  'IMG_3048.jpg',
  'IMG_3060.jpg',
]])

@ru
  <p>Океанариум расположен относительно высоко от парка.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2914.jpg'])

@ru
  <p>Фотозона 22 ноября.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2925.jpg'])

@ru
  <p>Панорама подхода к океанариуму из парка.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2926.jpg'])

@ru
  <p>Проход закрыт.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2927.jpg'])

@ru
  <p>Увлеченные посетители.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2935.jpg',
  'IMG_2939.jpg',
  'IMG_2941.jpg',
]])

@ru
  <p>В океанариуме.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2936.jpg',
  'IMG_2937.jpg',
  'IMG_2938.jpg',
  'IMG_2944.jpg',
  'IMG_2945.jpg',
  'IMG_2950.jpg',
  'IMG_2953.jpg',
  'IMG_2978.jpg',
  'IMG_2985.jpg',
]])

@ru
  <p>Угри.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2977.jpg',
  'IMG_2954.jpg',
  'IMG_2996.jpg',
]])

@ru
  <p>Вид выше и ниже уровня воды.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2982.jpg'])

@ru
  <p>Вид над водой.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2983.jpg'])

@ru
  <p>Вид под водой.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2984.jpg'])

@ru
  <p>Медуза.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2988.jpg',
  'IMG_2990.jpg',
]])

@ru
  <p>Круглое окошко.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2992.jpg'])

@ru
  <p>Разноцветные слои грунта.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2993.jpg'])

@ru
  <p>Самый большой аквариум.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2998.jpg',
  'IMG_2999.jpg',
  'IMG_3007.jpg',
]])

@ru
  <p>Рядом с выходом магазин с мерчем.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3022.jpg'])

@ru
  <p>Бассейн с дельфинами.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3035.jpg'])

@ru
  <p>Надпись гласит: «Осторожно, брызги воды». В следующую секунду дельфин обдает меня водой.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3037.jpg',
  'IMG_3038.jpg',
]])

@ru
  <p>Территория парка.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3039.jpg'])

@ru
  <p>Следующая остановка у руин.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3064.jpg',
  'IMG_3066.jpg',
  'IMG_3068.jpg',
  'IMG_3069.jpg',
  'IMG_3070.jpg',
  'IMG_3075.jpg',
  'IMG_3087.jpg',
  'IMG_3092.jpg',
]])

@ru
  <p>Дощатая дорога.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3090.jpg'])


@ru
  <p>Скамейки.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3107.jpg'])

@ru
  <p>Аллея деревьев, сбросивших листья.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3108.jpg'])

@ru
  <p>Проход запрещен.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3109.jpg'])

@ru
  <p>Выход.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3124.jpg'])

@ru
  <p>Умывальник на улице.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3125.jpg'])

@ru
  <p>Выгравированные надписи на столбе.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3126.jpg'])

@ru
  <p>Котик на лавке.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3151.jpg'])

@ru
  <p>Заброшенная моторная лодка.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3152.jpg'])

@ru
  <p>Следующая остановка — ананасовый парк.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3155.jpg'])

@ru
  <p>Реально ананасы растут.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3157.jpg',
  'IMG_3159.jpg',
]])

@ru
  <p>Фонтанчики.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3180.jpg'])

@ru
  <p>Могут прокатить по территории.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3181.jpg'])

@ru
  <p>Надпись на табличке: «кофе».</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3182.jpg'])

@ru
  <p>Территория парка.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3190.jpg',
  'IMG_3191.jpg',
  'IMG_3192.jpg',
  'IMG_3195.jpg',
  'IMG_3196.jpg',
  'IMG_3214.jpg',
]])

@ru
  <p>Подставка для телефона, чтобы самостоятельно сделать групповое фото.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3215.jpg'])

@ru
  <p>Динозавры со звуковым сопровождением.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3218.jpg',
  'IMG_3220.jpg',
  'IMG_3221.jpg',
]])

@ru
  <p>Еще фонтан.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3232.jpg'])

@ru
  <p>Возвращение в Наху.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3234.jpg'])

@ru
  <p>Наклейка на рюкзак, чтобы приняли за своего при посадке в автобус. Просили ее выбросить по завершении тура, но она осталась наклеена на память.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3236.jpg'])

@ru
  <p>Доставили в город, когда уже стемнело. А темнеет рано.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3240.jpg'])

@ru
  <p>Огни вечернего города.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3242.jpg',
  'IMG_3243.jpg',
]])

@ru
  <p>Напоминание об эвакуации во время природных катаклизмов.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3245.jpg'])

@ru
  <p>Сад.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3246.jpg',
  'IMG_3247.jpg',
  'IMG_3249.jpg',
  'IMG_3296.jpg',
  'IMG_3297.jpg',
  'IMG_3321.jpg',
]])

@ru
  <p>Очень нравятся листья с обведенным контуром.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3283.jpg'])

@ru
  <p>Пещера.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3304.jpg'])

@ru
  <p>Каменная арка.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3305.jpg'])

@ru
  <p>Бамбук.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3313.jpg'])

@ru
  <p>В саду есть черепахи.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3323.jpg'])

@ru
  <p>Не то крокодилья, не то драконья голова.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3346.jpg'])

@ru
  <p>Расшифровка вкуса вина на этикетке в магазине.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3358.jpg'])

@ru
  <p>Панорама площадки.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3370.jpg'])

@ru
  <p>Круговые скамейки.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3373.jpg',
  'IMG_3374.jpg',
]])

@ru
  <p>Пронумерованное такси поворачивает с односторонней дороги.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3378.jpg'])

@ru
  <p>Красные фонари вдоль территории ярмарки.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3379.jpg'])

@ru
  <p>Уличное пространство.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3380.jpg'])

@ru
  <p>Черного котика просьба не кормить.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3381.jpg'])

@ru
  <p>На ценниках картинки товара, в данном случае мороженого.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3382.jpg'])

@ru
  <p>Детская площадка в парке.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3383.jpg'])

@ru
  <p>Мост через дорогу в вытянутом парке.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3384.jpg',
  'IMG_3385.jpg',
  'IMG_3388.jpg',
]])

@ru
  <p>Дороги.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3386.jpg',
  'IMG_3387.jpg',
]])

@ru
  <p>Музей искусств.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3389.jpg'])

@ru
  <p>Второй мост через дорогу.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3390.jpg'])

@ru
  <p>Красиво цветут деревья.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3391.jpg'])

@ru
  <p>Десятки детей играют на спортивных площадках.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3392.jpg'])

@ru
  <p>Скейт-парк.</p>
@en
  <p>Skate park.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3393.jpg'])

@ru
  <p>Теннисный корт.</p>
@en
  <p>Tennis court.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3394.jpg'])

@ru
  <p>Закат в городе.</p>
@en
  <p>Sunset in the city.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3421.jpg'])

@ru
  <p>Лодка.</p>
@en
  <p>Boat.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3422.jpg'])

@ru
  <p>Газовая плита дома.</p>
@en
  <p>Gas stove at home.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3425.jpg'])

@ru
  <p>Вытяжка.</p>
@en
  <p>Cooker hood.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3426.jpg'])

@ru
  <p>В аэропорту на внутренних перелетах можно просканировать на опасность свой бутилированный напиток и забрать его дальше с собой, а не выбрасывать перед досмотром.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3427.jpg'])
@endsection

@extends('life.trips.base')

@section('content')
@ru
  <p>Хороший признак приятного города — это когда на этапе отбора фотографий для публикации мало какие хочется отсеять. До этой страницы добралось ни много ни мало аж 160!</p>
@endru

@ru
  <p>Будапешт — хороший бюджетный вариант для калужанина начать путешествие по Европе. Подать все документы на визу можно прямо в Калуге. Принимают даже бронь жилья с <a class="link" href="https://www.airbnb.ru/{{ config('cfg.airbnb_link') }}">Airbnb</a> — в соответствующих полях анкеты пишется apartment и контактные данные хоста: телефон и адрес. Из Москвы прямым сообщением летает лоукостер WizzAir. В самой Венгрии цены на удивление доступные — куда дешевле западной Европы.</p>
@endru

@ru
  <p>Улицы.</p>
@en
  <p>Streets.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3178.jpg',
  'IMG_3182.jpg',
  'IMG_3200.jpg',
  'IMG_3201.jpg',
  'IMG_3206.jpg',
  'IMG_3225.jpg',
  'IMG_3238.jpg',
  'IMG_3308.jpg',
  'IMG_3309.jpg',
  'IMG_3317.jpg',
  'IMG_3361.jpg',
  'IMG_3401.jpg',
  'IMG_3591.jpg',
  'IMG_3593.jpg',
  'IMG_3595.jpg',
  'IMG_3596.jpg',
  'IMG_3618.jpg',
  'IMG_3624.jpg',
  'IMG_3626.jpg',
]])

@ru
  <p>Искусно разрисованные фасады.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3179.jpg',
  'IMG_3590.jpg',
]])

@ru
  <p>Настоящие тоже интересны.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3592.jpg',
  'IMG_3629.jpg',
]])

@ru
  <p>Такси можно оплатить картой.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3181.jpg'])

@ru
  <p>Вход в метро.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3402.jpg',
  'IMG_3187.jpg',
]])

@ru
  <p>Метро.</p>
@en
  <p>Metro.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3183.jpg',
  'IMG_3321.jpg',
  'IMG_3531.jpg',
  'IMG_3322.jpg',
  'IMG_3323.jpg',
  'IMG_3504.jpg',
  'IMG_3506.jpg',
  'IMG_3362.jpg',
  'IMG_3363.jpg',
  'IMG_3364.jpg',
  'IMG_3365.jpg',
  'IMG_3403.jpg',
]])

@ru
  <p>Напольный рисунок объясняет изменения вследствие ремонтных работ на станции.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3184.jpg'])

@ru
  <p>Автобусы разных эпох.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3185.jpg'])

@ru
  <p>Трамваи. Шестой маршрут днем ходит каждые 10 минут, а ночью каждые 15 минут. Прекрасный способ перемещения в любое время суток.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3186.jpg',
  'IMG_3227.jpg',
  'IMG_3228.jpg',
  'IMG_3249.jpg',
  'IMG_3358.jpg',
  'IMG_3628.jpg',
]])

@ru
  <p>Здания.</p>
@en
  <p>Buildings.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3207.jpg',
  'IMG_3318.jpg',
  'IMG_3334.jpg',
  'IMG_3336.jpg',
  'IMG_3337.jpg',
  'IMG_3400.jpg',
  'IMG_3598.jpg',
  'IMG_3188.jpg',
]])

@ru
  <p>Автомобильный номер.</p>
@en
  <p>License plate.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3189.jpg'])

@ru
  <p>Парковка на тротуаре. Даже елочка нарисована.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3190.jpg'])

@ru
  <p>А под этим знаком нарисовано в какие дни действуют ограничения.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3198.jpg'])

@ru
  <p>На такой лавке и прилечь удобно.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3196.jpg'])

@ru
  <p>Велодорожки.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3197.jpg',
  'IMG_3250.jpg',
]])

@ru
  <p>Велонасос.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3343.jpg'])

@ru
  <p>Компактная заправка прямо в городе.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3199.jpg'])

@ru
  <p>Цвета подсказывают куда идти.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3202.jpg'])

@ru
  <p>Внимательному читателю предлагается найти на снимке кондиционер.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3203.jpg'])

@ru
  <p>Скромная остановка.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3204.jpg'])

@ru
  <p>Остановка поинтереснее.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3205.jpg'])

@ru
  <p>Телефонная будка.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3211.jpg'])

@ru
  <p>Тротуары посыпают зеленой крошкой.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3216.jpg'])

@ru
  <p>Местные надписи на заборе стройки. Венгерский на русский совершенно не похож.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3218.jpg'])

@ru
  <p>Места для прогулок.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3222.jpg',
  'IMG_3223.jpg',
  'IMG_3234.jpg',
  'IMG_3299.jpg',
  'IMG_3615.jpg',
  'IMG_3393.jpg',
  'IMG_3394.jpg',
  'IMG_3398.jpg',
]])

@ru
  <p>Длинная лавка.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3224.jpg'])

@ru
  <p>При пересмотре отснятого материала на этом снимке была обнаружена афиша концерта Ханса Циммера — повод вернуться в Будапешт 1 июня. В программе саундтреки из игр и фильмов.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3226.jpg'])

@ru
  <p>Дороги. Ни дня не обойдется, чтобы не услышать мигалки.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3229.jpg',
  'IMG_3230.jpg',
  'IMG_3245.jpg',
  'IMG_3251.jpg',
  'IMG_3253.jpg',
  'IMG_3274.jpg',
  'IMG_3310.jpg',
  'IMG_3315.jpg',
  'IMG_3329.jpg',
  'IMG_3349.jpg',
  'IMG_3357.jpg',
]])

@ru
  <p>Троллейбус Икарус.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3239.jpg'])

@ru
  <p>Чем не <a class="link" href="spb">Петербург</a>?</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3240.jpg',
  'IMG_3241.jpg',
  'IMG_3242.jpg',
  'IMG_3243.jpg',
]])

@ru
  <p>Двор-колодец в доме. Снаружи дубак, внутри квартиры тоже дубак, если нет обогревателя.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3248.jpg'])

@ru
  <p>На втором этаже ловко припрятана стремянка.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3589.jpg'])

@ru
  <p>Информация на остановке: карта, расписание и маршруты.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3252.jpg'])

@ru
  <p>Ночные автобусы с интервалом каждые полчаса (а из-за наличия множества пересекающихся маршрутов и вовсе чаще) помогут добраться до аэропорта, когда метро закрыто. Да и не только до аэропорта, конечно же.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3594.jpg'])

@ru
  <p>Подъем к панорамным местам.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3313.jpg'])

@ru
  <p>По такой узенькой дорожке вдоль перил только и идти, если нет желания упасть.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3287.jpg'])

@ru
  <p>Панорамы.</p>
@en
  <p>Panoramas.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3212.jpg',
  'IMG_3215.jpg',
  'IMG_3217.jpg',
  'IMG_3219.jpg',
  'IMG_3220.jpg',
  'IMG_3275.jpg',
  'IMG_3288.jpg',
]])

@ru
  <p>Сочетание зелени и снега в одном места.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3301.jpg',
  'IMG_3302.jpg',
]])

@ru
  <p>Философский сад.</p>
@en
  <p>Philosophical garden.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3312.jpg'])

@ru
  <p>Дунай.</p>
@en
  <p>Danube river.</p>
@endru
<youtube title="Budapest River, January 2017" v="N3IkMR5eurA"></youtube>
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3235.jpg',
  'IMG_3316.jpg',
]])

@ru
  <p>Уточки плавают.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3327.jpg',
  'IMG_3324.jpg',
]])

@ru
  <p>Лавочки.</p>
@en
  <p>Benches.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3325.jpg',
  'IMG_3326.jpg',
  'IMG_3328.jpg',
  'IMG_3344.jpg',
]])

@ru
  <p>Площадь героев.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3330.jpg'])

@ru
  <p>Каток.</p>
@en
  <p>Rink.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3332.jpg'])

@ru
  <p>Елку выбросил. Слабак.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3338.jpg'])

@ru
  <p>Паркомат.</p>
@en
  <p>Parking meter.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3342.jpg'])

@ru
  <p>Линейка в подземном переходе.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3345.jpg'])

@ru
  <p>Электрошкафы.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3346.jpg'])

@ru
  <p>Раздельный сбор мусора.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3348.jpg'])

@ru
  <p>Указатели улиц.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3350.jpg',
  'IMG_3351.jpg',
  'IMG_3352.jpg',
  'IMG_3353.jpg',
  'IMG_3532.jpg',
]])

@ru
  <p>Навигация с тактильным шрифтом.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3355.jpg'])

@ru
  <p>Рынок.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3359.jpg'])

@ru
  <p>При входе на рынок обязательно нужно обтереться о шторку.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3360.jpg'])

@ru
  <p>Схема метро и ж/д транспорта.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3367.jpg'])

@ru
  <p>По зеленой ветке ходят составы без машинистов.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3371.jpg'])

@ru
  <p>Цельный состав.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3374.jpg'])

@ru
  <p>Карта зеленой ветки в вагоне.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3376.jpg'])

@ru
  <p>Уличная навигация.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3379.jpg'])

@ru
  <p>Смешение цветов.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3385.jpg'])

@ru
  <p>Автомат по покупке ж/д билетов. Если рейс заранее оплатить через интернет, то по десятизначному коду заказа в автомате можно распечатать билет. Электронные пока не предусмотрены.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3493.jpg'])

@ru
  <p>Кладбище. Немало русских имен.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3508.jpg',
  'IMG_3509.jpg',
  'IMG_3511.jpg',
  'IMG_3512.jpg',
  'IMG_3513.jpg',
  'IMG_3514.jpg',
]])

@ru
  <p>Аллея деревьев — место для красочных осенних снимков.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3507.jpg',
  'IMG_3510.jpg',
]])

@ru
  <p>Супермаркет расположился внутри рынка.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3588.jpg'])

@ru
  <p>Слет на районе.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3604.jpg'])

@ru
  <p>В посудине такого размера можно подать целое блюдо из молотого перца.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3609.jpg'])

@ru
  <p>Над домофоном расписаны все жильцы.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3614.jpg'])

@ru
  <p>Жилые районы.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3533.jpg',
  'IMG_3616.jpg',
]])

@ru
  <p>Прозрачный подъезд.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3617.jpg'])

@ru
  <p>Двор.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3619.jpg'])

@ru
  <p>Стройка.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3620.jpg'])

@ru
  <p>Выходы в метро подписаны буквами. Удобно договариваться у какого встретиться.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3630.jpg'])

@ru
  <p>Кино в Будапеште показывают как в дубляже, так и в оригинале с субтитрами, причем оригинальный язык может быть немецким, французским и т.п., а не только английским. 3D-очки продают вместе с билетом, а дальше их забираешь домой и сам за ними ухаживаешь. Но никто не запрещает при каждом походе покупать новые, благо стоят недорого.</p>
@endru

@ru
  <p>Дабы вместо сна скоротать время перед ранним вылетом, было решено посмотреть Обитель зла на венгерском в формате 4DX (с эффектами). Ее пустили в прокат на несколько недель раньше премьеры в России. Контролер был один на 14 залов кино, билеты без проблем считывает с экрана телефона. Его ничуть не смущает, что ты говоришь с ним на английском, когда направляешься на венгерский сеанс. Во время просмотра снова убедился, что сходу в венгерском ничего разобрать невозможно из-за других корней языка. Словацкий и чешский нам куда ближе.</p>
@endru

@ru
  <p>А вы смотрели Утяжок?</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3631.jpg'])
@endsection

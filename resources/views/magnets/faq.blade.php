@extends('magnets.base')
@include('livewire')

@section('content')
<div class="max-w-[700px]">
  @component('accordion')
    @slot('title')
      Что это за ресурс?
    @endslot

    <div>Сайт, на котором можно скачать раздачи rutracker.org с помощью магнет-ссылок. Преимущество ссылок в отсутствии необходимости регистрироваться для скачивания.</div>
  @endcomponent

  @component('accordion')
    @slot('title')
      Для кого он?
    @endslot

    <div>Главным образом для тех, кто хочет делиться находками на рутрекере, а также следить за обновлениями раздач на нем.</div>
  @endcomponent

  @component('accordion')
    @slot('title')
      Чем отличается от других торрент-трекеров?
    @endslot

    <div>Тем, что для добавления раздачи достаточно вставить ссылку на нее. Где еще можно добавить 5-10 раздач за минуту?</div>
  @endcomponent

  @component('accordion')
    @slot('title')
      Как скачать раздачу?
    @endslot

    <p>По клику на иконку @svg (magnet) в списке раздач, либо на кнопку «Магнет» на странице раздачи. Качать можно без регистрации. Ваш торрент-клиент должен поддерживать магнет-ссылки.</p>
    <div class="mb-1">Рекомендуемые клиенты:</div>
    <ul>
      <li>
        <a class="link" href="@lng/files/158/dl">qBittorrent</a>
        <span title="Windows">
          @svg (windows)
        </span>
      </li>
      <li>
        <a class="link" href="@lng/files/151/dl">Transmission</a>
        <span title="macOS">
          @svg (apple)
        </span>
      </li>
    </ul>
  @endcomponent

  @component('accordion')
    @slot('title')
      Почему в торрент-клиенте сразу не видно список файлов раздачи?
    @endslot

    <div>Вашему торрент-клиенту нужно время, чтобы получить список файлов раздачи. Обычно этот процесс занимает не более минуты. Дело в том, что торрент-клиент по магнет-ссылке запрашивает у других участников обмена торрент-файл. Именно торрент-файл содержит список файлов, после его получения начинается действительное скачивание раздачи.</div>
  @endcomponent

  @component('accordion')
    @slot('title')
      Как добавить раздачу?
    @endslot

    <div class="mb-1">Для добавления предусмотрена <a class="link" href="@lng/magnets/add">отдельная страница</a>, доступная только зарегистрированным пользователям. В качестве ввода принимается три типа значений:</div>
    <ol>
      <li>Ссылка на раздачу на рутрекере вида <span class="font-mono text-greenish-600 text-sm">https://rutracker.org/forum/<wbr>viewtopic.php?t=4031882</span>. Также поддерживаются адреса rutracker.cr, rutracker.net, rutracker.nl и maintracker.org</li>
      <li>Инфо-хэш раздачи вида <span class="font-mono text-greenish-600 text-sm">9B5D85FFC234737E7D7C<wbr>246FECB6BB1EC5E8F0B9</span></li>
      <li>Номер темы на рутрекере вида <span class="font-mono text-greenish-600 text-sm">4031882</span></li>
    </ol>
  @endcomponent

  @component('accordion')
    @slot('title')
      Какую учетную запись использовать для входа?
    @endslot

    <div>Ту, что заводили на сайте <span class="font-bold">ivacuum.ru</span>. Если вы хоть раз загружали картинки в галерею, то у вас есть эта учетка. От прежнего трекера <span class="font-bold">t.ivacuum.ru</span> учетные записи, к сожалению, не подходят. Если вам нужна помощь, чтобы найти свою учетку, созданные многие годы назад (во времена провайдера Спарк, например), то напишите мне в личку в <a class="link" href="https://vk.com/ivacuum">ВК</a> — постараемся ее найти.</div>
  @endcomponent

  @component('accordion')
    @slot('title')
      Как добавить раздачу, которой нет на рутрекере?
    @endslot

    <div>Сперва добавить ее на рутрекер, а потом указать ссылку на нее.</div>
  @endcomponent

  @component('accordion')
    @slot('title')
      Как обновить раздачу?
    @endslot

    <div>Ручное редактирование на данный момент не предусмотрено. Обновление раздачи автоматически происходит каждые шесть часов по ссылке, которая использовалась при ее добавлении.</div>
  @endcomponent

  {{--
  @component('accordion')
    @slot('title')
      Кто такой сид?
    @endslot

    <p>Источник, с которого можно скачать раздачу целиком. Чем больше сидов, тем быстрее происходит обмен данными и, соответственно, скачивание раздачи.</p>
  @endcomponent
  --}}

  @component('accordion')
    @slot('title')
      Почему моя раздача пропала?
    @endslot

    <div>Раздачи автоматически удаляются, если они были удалены или закрыты на сайте-первоисточнике rutracker.org.</div>
  @endcomponent

  @component('accordion')
    @slot('title')
      Как комментировать раздачи?
    @endslot

    <div>Для участия в дискуссии нужно быть зарегистрированным пользователем сайта. На странице раздачи под ее описанием и комментариями других пользователей располагается форма написания комментария.</div>
  @endcomponent

  <div class="h3 mt-12">@lang('Обратная связь')</div>
  @ru
    <p>Поделитесь своими знаниями или задайте вопрос. Мы постараемся обработать информацию и дополнить эту страницу новыми материалами.</p>
  @en
    <p>Use the form below to ask a question or just to tell us how to make this page better.</p>
  @endru
  @livewire(App\Http\Livewire\FeedbackForm::class, [
    'title' => 'Magnets FAQ',
    'hideTitle' => true,
  ])
</div>
@endsection

@extends('magnets.base')

@section('content')
@if (count($magnets))
  <table class="table-stats table-adaptive">
    <thead>
      <tr>
        <th>{{ ViewHelper::modelFieldTrans('magnet', 'title') }}</th>
        <th class="text-muted md:text-right" title="{{ ViewHelper::modelFieldTrans('magnet', 'views') }}">@svg (eye)</th>
        <th class="md:text-right" title="{{ ViewHelper::modelFieldTrans('magnet', 'comments') }}">@svg (comment-o)</th>
        <th class="md:text-right" title="{{ ViewHelper::modelFieldTrans('magnet', 'clicks') }}">@svg (magnet)</th>
        <th>{{ ViewHelper::modelFieldTrans('magnet', 'size') }}</th>
        <th>{{ ViewHelper::modelFieldTrans('magnet', 'updated_at') }}</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php /** @var \App\Magnet $magnet */ ?>
      @foreach ($magnets as $magnet)
        <tr>
          <td><a class="visited" href="{{ $magnet->www() }}">{{ $magnet->shortTitle() }}</a></td>
          <td class="text-muted md:text-right whitespace-nowrap">{{ $magnet->views ? ViewHelper::number($magnet->views) : '' }}</td>
          <td class="md:text-right whitespace-nowrap">{{ $magnet->comments_count ? ViewHelper::number($magnet->comments_count) : '' }}</td>
          <td class="md:text-right whitespace-nowrap">{{ $magnet->clicks ? ViewHelper::number($magnet->clicks) : '' }}</td>
          <td class="text-muted whitespace-nowrap">{{ ViewHelper::size($magnet->size) }}</td>
          <td>{{ ViewHelper::dateShort($magnet->registered_at) }}</td>
          <td>
            <a class="visited" href="{{ $magnet->externalLink() }}">
              @svg (external-link)
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  @include('tpl.paginator', ['paginator' => $magnets])
@else
  @ru
    <p>Вы еще не добавили ни одной раздачи.</p>
  @en
    <p>You haven't released anything yet.</p>
  @endru
  <p><a class="btn btn-default" href="@lng/magnets/add">@lang('Добавить раздачу')</a></p>
@endif
@endsection

<?php /** @var \App\Livewire\Acp\ArtistList $this */ ?>

<div>
  <table class="table-stats table-adaptive">
    <thead>
    <tr>
      <x-th key="title"/>
      <x-th key="slug"/>
    </tr>
    </thead>
    <tbody>
    @foreach ($this->models as $model)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ Acp::edit($model) }}" wire:key="{{ $model->id }}">
        <td>
          <a href="{{ Acp::show($model) }}">
            {{ $model->title }}
          </a>
        </td>
        <td>{{ $model->slug }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>

  {{ $this->models->links() }}
</div>

<?php /** @var \App\Http\Livewire\Acp\MagnetForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php $form = LivewireForm::model($this->magnet); ?>

  <div class="mb-4">
    <label class="font-bold input-required">Рубрика</label>
    <select required class="form-input" wire:model="magnet.category_id">
      <option value="">Выберите рубрику...</option>
      @foreach (TorrentCategoryHelper::tree() as $id => $category)
        <option value="{{ $id }}" {{ !empty($category['children']) ? 'disabled' : '' }}>
          {{ $category['title'] }}
        </option>
        @if (!empty($category['children']))
          @foreach ($category['children'] as $id => $category)
            <option value="{{ $id }}">
              &nbsp;&nbsp;&nbsp;&nbsp;{{ $category['title'] }}
            </option>
          @endforeach
        @endif
      @endforeach
    </select>
    <x-invalid-feedback field="magnet.category_id"/>
  </div>

  {{ $form->text('magnet.rto_id')->required() }}
  {{ $form->radio('magnet.status')->required()->values(App\Domain\MagnetStatus::labels()) }}
  {{ $form->text('magnet.related_query') }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->magnet->exists ? 'acp.save' : 'acp.magnets.add')
    </button>
  </div>
</form>

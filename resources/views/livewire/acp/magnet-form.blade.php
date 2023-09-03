<?php /** @var \App\Livewire\Acp\MagnetForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit="submit">
  <?php $form = LivewireForm::model(App\Magnet::class); ?>

  <div class="mb-4">
    <label class="font-bold input-required">Рубрика</label>
    <select required class="form-input" wire:model.live="categoryId">
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
    <x-invalid-feedback field="categoryId"/>
  </div>

  {{ $form->text('rtoId')->required() }}
  {{ $form->radio('status')->required()->values(App\Domain\MagnetStatus::labels()) }}
  {{ $form->text('relatedQuery') }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->id ? 'acp.save' : 'acp.magnets.add')
    </button>
  </div>
</form>

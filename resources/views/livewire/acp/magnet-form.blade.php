<?php /** @var \App\Livewire\Acp\MagnetForm $this */ ?>

<form class="grid grid-cols-1 gap-6 md:gap-4" wire:submit="submit">
  <?php $form = LivewireForm::model(App\Magnet::class); ?>

  <div class="md:grid md:grid-cols-(--form-two-columns) md:gap-4">
    <label class="font-bold md:leading-6 md:pt-1.5 input-required">Рубрика</label>
    <div class="max-md:mt-1.5">
      <select required class="the-input" wire:model.live="categoryId">
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
    </div>
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

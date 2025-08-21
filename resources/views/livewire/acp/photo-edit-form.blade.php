<?php /** @var \App\Livewire\Acp\PhotoEditForm $this */ ?>

<form class="grid grid-cols-1 gap-6 md:gap-4" wire:submit="submit">
  <?php LivewireForm::model($this->photo); ?>

  @include('tpl.form_errors')

  <div class="mb-6">
    <img class="image-fit-viewport -mx-4 sm:mx-0 sm:rounded-sm max-w-full" src="{{ $this->photo->originalUrl() }}" alt="">
  </div>

  <div class="mb-4">
    <label class="font-bold">@lang('acp.tags.index')</label>
    <div class="column-width-48">
      @foreach (\App\Domain\Life\Models\Tag::query()->orderBy(\App\Domain\Life\Models\Tag::titleField())->get() as $tag)
        <label class="flex gap-2 items-center">
          <input
            class="not-checked:border-gray-300 text-sky-600 rounded-sm"
            type="checkbox"
            wire:model.live="tags"
            value="{{ $tag->id }}"
          >
          {{ $tag->title }}
        </label>
      @endforeach
    </div>
    <x-invalid-feedback field="tags"/>
  </div>

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang('acp.save')
    </button>
  </div>
</form>

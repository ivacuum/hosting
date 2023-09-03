<?php /** @var \App\Livewire\Acp\PhotoEditForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit="submit">
  <?php LivewireForm::model($this->photo); ?>

  @include('tpl.form_errors')

  <div class="mb-6">
    <img class="image-fit-viewport -mx-4 sm:mx-0 sm:rounded max-w-full" src="{{ $this->photo->originalUrl() }}" alt="">
  </div>

  <div class="mb-4">
    <label class="font-bold">@lang('acp.tags.index')</label>
    <div class="column-width-48">
      @foreach (App\Tag::orderBy(App\Tag::titleField())->get() as $tag)
        <label class="flex gap-2 items-center">
          <input
            class="border-gray-300 rounded"
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

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php LivewireForm::model(new App\Photo); ?>

  @include('tpl.form_errors')

  <div class="mb-6">
    <img class="image-fit-viewport mobile-wide sm:rounded max-w-full" src="{{ $image }}" alt="">
  </div>

  <div class="mb-4">
    <label class="font-bold">@lang('acp.tags.index')</label>
    <div class="column-width-48">
      @foreach (App\Tag::orderBy(App\Tag::titleField())->get() as $tag)
        <label class="flex items-center">
          <input
            class="border-gray-300 rounded mr-2"
            type="checkbox"
            wire:model="tags"
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
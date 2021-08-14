@if (!$model->exists)
  {!! Form::select('trip_id')->classes(['js-append-formdata'])->values(App\TripFactory::forInputSelect())->html() !!}
  {!! Form::select('gig_id')->classes(['js-append-formdata'])->values(App\GigFactory::forInputSelect())->html() !!}

  <div class="mb-4">
    <label class="font-bold">@lang('acp.photos.index')</label>
    <images-uploader action="{{ path([$controller, 'store']) }}" append=".js-append-formdata"></images-uploader>
  </div>
@else
  <div class="mb-6">
    <img class="image-fit-viewport mobile-wide sm:rounded max-w-full" src="{{ $model->originalUrl() }}" alt="">
  </div>

  <div class="mb-4">
    <label class="font-bold">@lang('acp.tags.index')</label>
    <div class="column-width-48">
      @foreach (App\Tag::orderBy(App\Tag::titleField())->get() as $tag)
        <label class="flex items-center">
          <input
            class="border-gray-300 rounded mr-2"
            type="checkbox"
            name="tags[]"
            value="{{ $tag->id }}"
            {{ in_array($tag->id, (array) old('tags', !empty($model) ? $model->tags->modelKeys() : null)) ? 'checked' : '' }}
          >
          {{ $tag->title }}
        </label>
      @endforeach
    </div>
    <x-invalid-feedback field="tags"/>
  </div>
@endif

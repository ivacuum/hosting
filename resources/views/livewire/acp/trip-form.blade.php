<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php LivewireForm::model(new App\Trip); ?>

  @if ($modelId)
    {{ LivewireForm::text('title_ru')->required()->html() }}
    {{ LivewireForm::text('title_en')->required()->html() }}
  @endif

  {{ LivewireForm::select('city_id')->required()->values(App\City::forInputSelect())->html() }}

  {{ LivewireForm::text('slug')->required()->html() }}

  {{ LivewireForm::text('date_start')->required()->html() }}
  {{ LivewireForm::text('date_end')->required()->html() }}
  {{ LivewireForm::text('date_end')->required()->html() }}

  {{ LivewireForm::radio('status')->required()->values([
    App\Trip::STATUS_HIDDEN => 'Скрыта',
    App\Trip::STATUS_INACTIVE => 'Неактивна',
    App\Trip::STATUS_PUBLISHED => 'Опубликована',
  ])->html() }}

  {{ LivewireForm::text('meta_description_ru')->html() }}
  {{ LivewireForm::text('meta_description_en')->html() }}
  {{ LivewireForm::text('meta_image')->html() }}

  @if ($metaImageSrc)
    <div>
      <img class="max-w-full h-auto rounded" src="{{ $metaImageSrc }}" alt="">
    </div>
  @endif

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($modelId ? 'acp.save' : 'acp.trips.add')
    </button>
  </div>
</form>

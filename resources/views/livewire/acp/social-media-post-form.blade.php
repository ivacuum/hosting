<?php /** @var \App\Domain\SocialMedia\Livewire\SocialMediaPostForm $this */ ?>

<form class="grid grid-cols-1 gap-6 md:gap-4" wire:submit="submit">
  <?php $form = LivewireForm::model(\App\Domain\SocialMedia\Models\SocialMediaPost::class); ?>

  {{ $form->textarea('caption')->required(!$this->status?->isExcluded()) }}

  <div class="md:grid md:grid-cols-(--form-two-columns) md:gap-4">
    <label class="font-semibold md:leading-6 md:pt-1.5">{{ \ViewHelper::modelFieldTrans('social-media-post', 'photo_id') }}</label>
    <div class="aspect-4/3 w-full max-w-full max-md:mt-1.5">
      <img
        @class(['size-full rounded-sm object-contain', 'pointer' => !$this->id])
        src="{{ $this->photo->originalUrl() }}"
        alt=""
        @if (!$this->id)
          wire:click.prevent="pickRandomPhoto"
        @endif
      >
    </div>
  </div>

  {{ $form->radio('status')->required()->values(\App\Domain\SocialMedia\SocialMediaPostStatus::labels()) }}
  {{ $form->datetimeLocal('publishedAt')->required(!$this->status?->isExcluded()) }}

  <div class="sticky-bottom-buttons">
    <div class="md:grid md:grid-cols-(--form-two-columns) md:gap-4">
      <div></div>
      <div>
        <button type="submit" class="btn btn-primary">
          @lang($this->id ? 'acp.save' : 'acp.social-media-posts.add')
        </button>
      </div>
    </div>
  </div>
</form>

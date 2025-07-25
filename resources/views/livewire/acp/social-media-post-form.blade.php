<?php /** @var \App\Livewire\Acp\SocialMediaPostForm $this */ ?>

<form class="grid grid-cols-1 gap-6 md:gap-4" wire:submit="submit">
  <?php $form = LivewireForm::model(\App\Domain\SocialMedia\Models\SocialMediaPost::class); ?>

  {{ $form->textarea('caption')->required() }}

  <div class="md:grid md:grid-cols-(--form-two-columns) md:gap-4">
    <label class="font-semibold md:leading-6 md:pt-1.5">{{ \ViewHelper::modelFieldTrans('social-media-post', 'photo_id') }}</label>
    <div class="max-md:mt-1.5">
      <img
        class="rounded-sm pointer"
        src="{{ $this->photo->originalUrl() }}"
        alt=""
        wire:click.prevent="pickRandomPhoto"
      >
    </div>
  </div>

  {{ $form->radio('status')->required()->values(\App\Domain\SocialMedia\SocialMediaPostStatus::labels()) }}
  {{ $form->datetimeLocal('publishedAt')->required() }}

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

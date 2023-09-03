<?php /** @var \App\Livewire\Acp\NewsForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit="submit">
  <?php $form = LivewireForm::model(App\News::class); ?>

  {{ $form->text('title')->required() }}
  {{ $form->radio('status')->required()->values(App\Domain\NewsStatus::labels()) }}
  {{ $form->textarea('markdown')->wide()->required() }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->id ? 'acp.save' : 'acp.news.add')
    </button>
  </div>
</form>

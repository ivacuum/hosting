<?php /** @var \App\Livewire\Acp\CommentForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit="submit">
  <?php $form = LivewireForm::model(App\Comment::class); ?>

  {{ $form->radio('status')->required()->values(App\Domain\CommentStatus::labels()) }}
  {{ $form->textarea('html')->required()->wide() }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->id ? 'acp.save' : 'acp.comments.add')
    </button>
  </div>
</form>

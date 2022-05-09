<?php /** @var \App\Http\Livewire\Acp\CommentForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php $form = LivewireForm::model($this->comment); ?>

  {{ $form->radio('comment.status')->required()->values(App\Domain\CommentStatus::labels()) }}
  {{ $form->textarea('comment.html')->required()->wide() }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->comment->exists ? 'acp.save' : 'acp.comments.add')
    </button>
  </div>
</form>

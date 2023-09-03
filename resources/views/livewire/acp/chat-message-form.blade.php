<?php /** @var \App\Livewire\Acp\ChatMessageForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit="submit">
  <?php $form = LivewireForm::model(App\ChatMessage::class); ?>

  {{ $form->radio('status')->required()->values(App\Domain\ChatMessageStatus::labels()) }}
  {{ $form->textarea('text')->required()->wide() }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->id ? 'acp.save' : 'acp.chat-messages.add')
    </button>
  </div>
</form>

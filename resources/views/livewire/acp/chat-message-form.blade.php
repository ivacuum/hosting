<?php /** @var \App\Http\Livewire\Acp\ChatMessageForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php $form = LivewireForm::model($this->chatMessage); ?>

  {{ $form->radio('chatMessage.status')->required()->values(App\Domain\ChatMessageStatus::labels()) }}
  {{ $form->textarea('chatMessage.text')->required()->wide() }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->chatMessage->exists ? 'acp.save' : 'acp.chat-messages.add')
    </button>
  </div>
</form>

<?php /** @var \App\Livewire\Acp\UserForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit="submit">
  <?php $form = LivewireForm::model(App\User::class); ?>

  {{ $form->text('email')->required() }}
  {{ $form->radio('status')->values(App\Domain\UserStatus::labels()) }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->id ? 'acp.save' : 'acp.users.add')
    </button>
  </div>
</form>

<?php /** @var \App\Http\Livewire\Acp\UserForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php $form = LivewireForm::model($this->user); ?>

  {{ $form->text('user.email')->required() }}
  {{ $form->radio('user.status')->values(App\Domain\UserStatus::labels()) }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->user->exists ? 'acp.save' : 'acp.users.add')
    </button>
  </div>
</form>

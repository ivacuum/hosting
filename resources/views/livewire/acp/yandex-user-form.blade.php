<?php /** @var \App\Http\Livewire\Acp\YandexUserForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php $form = LivewireForm::model($this->yandexUser); ?>

  {{ $form->text('yandexUser.account')->required() }}
  {{ $form->text('token')->required(!$this->yandexUser->exists) }}
  {{ $form->checkbox('domains')->values(App\Domain::tap(new App\Scope\DomainYandexReadyScope($this->yandexUser->id))->pluck('domain', 'id')) }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->yandexUser->exists ? 'acp.save' : 'acp.yandex-users.add')
    </button>
  </div>
</form>

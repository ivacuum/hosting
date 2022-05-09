<?php /** @var \App\Http\Livewire\Acp\DomainForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php $form = LivewireForm::model($this->domain); ?>

  {{ $form->text('domain.domain')->required()->placeholder('example.com') }}

  {{ $form->select('domain.alias_id')->values(App\Domain::orderBy('domain')->pluck('domain', 'id')) }}

  {{ $form->select('domain.client_id')->required()->values(App\Client::pluck('name', 'id')) }}

  {{ $form->select('domain.yandex_user_id')->values(App\YandexUser::pluck('account', 'id')) }}

  {{ $form->checkbox('domain.status')
    ->label('')
    ->values([1 => 'Мониторинг домена']) }}

  {{ $form->checkbox('domain.domain_control')
    ->label('')
    ->values([1 => 'Домен в нашей панели reg.ru']) }}

  {{ $form->checkbox('domain.orphan')
    ->label('')
    ->values([1 => 'Домен на продажу']) }}

  {{ $form->textarea('domain.text')->wide() }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->domain->exists ? 'acp.save' : 'acp.domains.add')
    </button>
  </div>
</form>

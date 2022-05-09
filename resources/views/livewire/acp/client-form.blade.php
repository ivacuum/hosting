<?php /** @var \App\Http\Livewire\Acp\ClientForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php $form = LivewireForm::model($this->client); ?>

  {{ $form->text('client.name')->required() }}
  {{ $form->text('client.email') }}
  {{ $form->textarea('client.text')->wide() }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->client->exists ? 'acp.save' : 'acp.clients.add')
    </button>
  </div>
</form>

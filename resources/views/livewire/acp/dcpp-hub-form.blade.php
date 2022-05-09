<?php /** @var \App\Http\Livewire\Acp\DcppHubForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php $form = LivewireForm::model($this->dcppHub); ?>

  {{ $form->text('dcppHub.title')->required() }}
  {{ $form->text('dcppHub.address')->required() }}
  {{ $form->text('dcppHub.port')->required() }}

  {{ $form->radio('dcppHub.status')->required()->values(App\Domain\DcppHubStatus::labels()) }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->dcppHub->exists ? 'acp.save' : 'acp.dcpp-hubs.add')
    </button>
  </div>
</form>

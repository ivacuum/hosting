<?php /** @var \App\Livewire\Acp\DcppHubForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit="submit">
  <?php $form = LivewireForm::model(App\DcppHub::class); ?>

  {{ $form->text('title')->required() }}
  {{ $form->text('address')->required() }}
  {{ $form->text('port')->required() }}

  {{ $form->radio('status')->required()->values(App\Domain\DcppHubStatus::labels()) }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->id ? 'acp.save' : 'acp.dcpp-hubs.add')
    </button>
  </div>
</form>

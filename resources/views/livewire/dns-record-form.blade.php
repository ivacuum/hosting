<?php /** @var \App\Http\Livewire\DnsRecordForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php LivewireForm::model('yandex-pdd-ns-record') ?>

  @if($this->recordId === null)
    {{ LivewireForm::radio('type')->values(App\Services\YandexPdd\DnsRecordType::casesThatCanBeAdded()) }}
  @endif

  {{ LivewireForm::text('subdomain') }}
  {{ LivewireForm::text('content') }}
  {{ LivewireForm::text('ttl') }}

  @if(in_array($this->type, ['MX', 'SRV']))
    {{ LivewireForm::text('priority') }}
  @endif

  @if($this->type === 'SRV')
    {{ LivewireForm::text('port') }}
    {{ LivewireForm::text('weight') }}
  @endif

  <div>
    <button type="submit" class="btn btn-primary">
      @lang('acp.save')
    </button>
  </div>
</form>

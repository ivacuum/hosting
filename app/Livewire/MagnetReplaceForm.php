<?php

namespace App\Livewire;

use App\Action\UpdateMagnetAction;
use App\Magnet;
use App\Services\Rto;
use Livewire\Component;

class MagnetReplaceForm extends Component
{
    public Magnet $magnet;
    public string|null $input = null;

    public function submit(UpdateMagnetAction $updateMagnet)
    {
        $this->validate();

        try {
            $updateMagnet->execute($this->magnet, $this->input);
        } catch (\Throwable $e) {
            $this->addError('input', $e->getMessage());

            // Failed to connect() to host or proxy.
            if (str_starts_with($e->getMessage(), 'cURL error 7:')) {
                return null;
            }

            // Connection reset by peer
            if (str_starts_with($e->getMessage(), 'cURL error 35:')) {
                return null;
            }

            report($e);

            return null;
        }

        return redirect($this->magnet->wwwAcp());
    }

    public function updatedInput(Rto $rto)
    {
        $this->input = $rto->findTopicId($this->input);
    }

    protected function rules()
    {
        return ['input' => 'required'];
    }
}

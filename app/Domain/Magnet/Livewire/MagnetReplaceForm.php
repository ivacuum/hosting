<?php

namespace App\Domain\Magnet\Livewire;

use App\Domain\Magnet\Action\UpdateMagnetAction;
use App\Domain\Magnet\Models\Magnet;
use App\Domain\Rto\Rto;
use App\Domain\Rto\RtoTemporarilyUnavailableException;
use App\Domain\Rto\RtoUnreachableException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;

class MagnetReplaceForm extends Component
{
    public Magnet $magnet;
    public string|null $input = null;

    public function render(): View
    {
        return view('livewire.magnet-replace-form');
    }

    public function submit(UpdateMagnetAction $updateMagnet): RedirectResponse|null
    {
        $this->validate();

        try {
            $updateMagnet->execute($this->magnet, $this->input);
        } catch (RtoTemporarilyUnavailableException) {
            $this->addError('input', 'Рутрекер временно недоступен. Пожалуйста, повторите попытку позже.');

            return null;
        } catch (RtoUnreachableException $e) {
            $this->addError('input', $e->getMessage());

            return null;
        } catch (\Throwable $e) {
            $this->addError('input', $e->getMessage());

            report($e);

            return null;
        }

        return redirect($this->magnet->wwwAcp());
    }

    public function updatedInput(Rto $rto): void
    {
        $this->input = $rto->findTopicId($this->input);
    }

    protected function rules(): array
    {
        return ['input' => 'required'];
    }
}

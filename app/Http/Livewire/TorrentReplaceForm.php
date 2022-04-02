<?php namespace App\Http\Livewire;

use App\Domain\TorrentUpdater;
use App\Magnet;
use App\Services\Rto;
use Livewire\Component;

class TorrentReplaceForm extends Component
{
    public int $modelId;
    public ?string $input = null;

    public function mount(int $modelId)
    {
        $this->modelId = $modelId;
    }

    public function rules()
    {
        return ['input' => 'required'];
    }

    public function submit()
    {
        $this->validate();

        $magnet = Magnet::findOrFail($this->modelId);
        $magnet->rto_id = $this->input;

        try {
            $action = app()->make(TorrentUpdater::class);
            $action->update($magnet);
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

        return redirect($magnet->wwwAcp());
    }

    public function updatedInput()
    {
        $this->input = app()
            ->make(Rto::class)
            ->findTopicId($this->input);
    }
}

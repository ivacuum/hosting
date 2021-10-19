<?php namespace App\Http\Livewire;

use App\Domain\TorrentUpdater;
use App\Services\Rto;
use App\Torrent;
use Livewire\Component;

class TorrentReplaceForm extends Component
{
    public int $modelId;
    public string $input = '';

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

        $torrent = Torrent::findOrFail($this->modelId);
        $torrent->rto_id = $this->input;

        try {
            $action = app()->make(TorrentUpdater::class);
            $action->update($torrent);
        } catch (\Throwable $e) {
            $this->addError('input', $e->getMessage());

            // Connection reset by peer
            if (str_starts_with($e->getMessage(), 'cURL error 35:')) {
                return null;
            }

            report($e);

            return null;
        }

        return redirect($torrent->wwwAcp());
    }

    public function updatedInput()
    {
        $this->input = app()
            ->make(Rto::class)
            ->findTopicId($this->input);
    }
}

<?php namespace App\Http\Livewire\Acp;

use App\DcppHub;
use App\Domain\DcppHubStatus;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class DcppHubForm extends Component
{
    use AuthorizesRequests;

    public int $port = 411;
    public int $status = DcppHubStatus::PUBLISHED;
    public ?int $modelId = null;
    public string $title = '';
    public string $address = '';
    public ?string $goto;

    public function mount(int $modelId = null)
    {
        if ($modelId) {
            $hub = DcppHub::findOrFail($modelId);

            $this->port = $hub->port;
            $this->title = $hub->title;
            $this->status = $hub->status->jsonSerialize();
            $this->address = $hub->address;
        }

        $this->goto = request('goto');
    }

    public function rules()
    {
        return [
            'port' => 'required|integer|min:1|max:65535',
            'title' => 'required',
            'address' => 'required',
        ];
    }

    public function submit()
    {
        $this->authorize('create', DcppHub::class);
        $this->validate();

        if ($this->modelId) {
            $this->update();

            return redirect()->to($this->goto ?? '/acp/dcpp-hubs');
        }

        $this->store();

        return redirect()->to($this->goto ?? '/acp/dcpp-hubs');
    }

    private function fillModel(DcppHub $hub)
    {
        $hub->port = $this->port;
        $hub->title = $this->title;
        $hub->status = $this->status;
        $hub->address = $this->address;
    }

    private function store()
    {
        $hub = new DcppHub;
        $this->fillModel($hub);
        $hub->save();
    }

    private function update()
    {
        $hub = DcppHub::findOrFail($this->modelId);
        $this->fillModel($hub);
        $hub->save();
    }
}

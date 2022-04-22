<?php namespace App\Http\Livewire\Acp;

use App\DcppHub;
use App\Domain\DcppHubStatus;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class DcppHubForm extends Component
{
    use AuthorizesRequests;

    public int $port = 411;
    public string $title = '';
    public string $address = '';
    public ?string $goto;
    public ?DcppHub $hub = null;
    public DcppHubStatus|int $status = DcppHubStatus::Published;

    public function mount()
    {
        if ($this->hub) {
            $this->port = $this->hub->port;
            $this->title = $this->hub->title;
            $this->status = $this->hub->status;
            $this->address = $this->hub->address;
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
        dump($this);
        $this->validate();
        $this->store();

        return redirect()->to($this->goto ?? '/acp/dcpp-hubs');
    }

    private function store()
    {
        $this->hub ??= new DcppHub;
        $this->hub->port = $this->port;
        $this->hub->title = $this->title;
        $this->hub->status = $this->status;
        $this->hub->address = $this->address;
        $this->hub->save();
    }
}

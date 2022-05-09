<?php namespace App\Http\Livewire\Acp;

use App\Action\SyncYandexUserDomainsAction;
use App\Http\Livewire\WithGoto;
use App\YandexUser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class YandexUserForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    public array $domains;
    public string $token = '';
    public YandexUser $yandexUser;

    public function mount()
    {
        $this->domains = $this->yandexUser->domains->modelKeys();
    }

    public function rules()
    {
        return [
            'token' => Rule::when(!$this->yandexUser->exists, 'required'),
            'domains' => 'array',
            'yandexUser.account' => [
                'required',
                Rule::unique($this->yandexUser::class, 'account')->ignore($this->yandexUser),
            ],
        ];
    }

    public function submit(SyncYandexUserDomainsAction $syncYandexUserDomains)
    {
        $this->authorize('update', $this->yandexUser);
        $this->validate();

        if ($this->token) {
            $this->yandexUser->token = $this->token;
        }

        $this->yandexUser->save();

        $syncYandexUserDomains->execute($this->yandexUser, $this->domains);

        return redirect()->to($this->goto ?? to('acp/yandex-users'));
    }
}

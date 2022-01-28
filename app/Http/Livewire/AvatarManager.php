<?php namespace App\Http\Livewire;

use App\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class AvatarManager extends Component
{
    use WithFileUploads;

    /** @var \Livewire\TemporaryUploadedFile */
    public $image;
    public string $avatar;
    public string $randomId;

    public function deleteAvatar()
    {
        tap(\Auth::user(), function (User $user) {
            $user->avatar = '';
            $user->save();
        });

        $this->avatar = '';
    }

    public function mount()
    {
        $this->avatar = \Auth::user()->avatarUrl();
        $this->resetChosenFile();
    }

    public function rules()
    {
        return [
            'image' => [
                'required',
                'mimetypes:image/jpeg,image/png',
                'max:3072',
            ],
        ];
    }

    public function updatedImage()
    {
        $this->validate();

        try {
            $this->avatar = \Auth::user()->uploadAvatar($this->image);
        } catch (\Throwable $e) {
            $this->addError('image', $e->getMessage());
        }

        $this->resetChosenFile();

        event(new \App\Events\Stats\UserAvatarUploaded);
    }

    private function resetChosenFile()
    {
        $this->randomId = \Str::random();
    }
}

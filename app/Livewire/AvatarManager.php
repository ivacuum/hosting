<?php

namespace App\Livewire;

use App\User;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class AvatarManager extends Component
{
    use WithFileUploads;

    public string $avatar;
    public string $randomId;

    #[Rule([
        'required',
        'image',
        'mimetypes:image/jpeg,image/png',
        'max:3072',
    ])]
    public $image;

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

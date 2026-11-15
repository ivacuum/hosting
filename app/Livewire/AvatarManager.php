<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class AvatarManager extends Component
{
    use WithFileUploads;

    public string $avatar;

    #[Validate([
        'required',
        'image',
        'mimetypes:image/jpeg,image/png',
        'max:3072',
        'dimensions:max_width=2000,max_height=2000',
    ], message: [
        'image.dimensions' => 'Изображение должно быть не больше :max_width×:max_height пикселей. Уменьшите его и попробуйте снова.',
    ])]
    public $image;

    public function deleteAvatar(): void
    {
        tap(Auth::user(), static function (User $user) {
            $user->avatar = '';
            $user->save();
        });

        $this->avatar = '';
    }

    public function mount(): void
    {
        $this->avatar = Auth::user()->avatarUrl();
    }

    public function updatedImage(): void
    {
        $this->validate();

        try {
            $this->avatar = Auth::user()->uploadAvatar($this->image);
        } catch (\Throwable $e) {
            throw ValidationException::withMessages(['image' => $e->getMessage()]);
        } finally {
            $this->reset('image');
        }

        event(new \App\Events\Stats\UserAvatarUploaded);
    }
}

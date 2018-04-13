<?php namespace App\Http\Controllers;

class MyAvatar extends Controller
{
    public function update()
    {
        if (!request()->ajax()) {
            return ['status' => 'error'];
        }

        request()->validate([
            'file' => 'required|mimetypes:image/jpeg,image/png|max:3072',
        ]);

        /* @var \App\User $user */
        $user = request()->user();
        $file = request()->file('file');

        if (null === $file || !$file->isValid()) {
            throw new \Exception('Необходимо предоставить хотя бы один файл');
        }

        $avatar = $user->uploadAvatar($file);

        event(new \App\Events\Stats\UserAvatarUploaded);

        return [
            'status' => 'OK',
            'avatar' => $avatar,
        ];
    }
}

<?php namespace App\Http\Controllers;

class MyAvatar extends Controller
{
    public function update()
    {
        if (!$this->request->ajax()) {
            return ['status' => 'error'];
        }

        $this->validate($this->request, [
            'file' => 'required|mimetypes:image/jpeg,image/png|max:3072',
        ]);

        $file = $this->request->file('file');
        $user = $this->request->user();

        if (is_null($file) || !$file->isValid()) {
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

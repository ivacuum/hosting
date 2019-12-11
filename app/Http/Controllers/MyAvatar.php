<?php namespace App\Http\Controllers;

use App\Http\Requests\MyAvatarUpdateRequest;
use App\User;
use Illuminate\Http\Request;

class MyAvatar extends Controller
{
    public function destroy(Request $request)
    {
        tap($request->user(), function (User $user) {
            $user->avatar = '';
            $user->save();
        });

        return response()->noContent();
    }

    public function update(MyAvatarUpdateRequest $request)
    {
        /** @var User $user */
        $user = $request->user();
        $file = $request->file('file');

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

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
        $avatar = $request->userModel()
            ->uploadAvatar($request->avatar());

        event(new \App\Events\Stats\UserAvatarUploaded);

        return [
            'status' => 'OK',
            'avatar' => $avatar,
        ];
    }
}

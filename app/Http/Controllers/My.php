<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Validation\Rule;

class My extends Controller
{
    public function index()
    {
        return view($this->view);
    }

    public function avatarPut()
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

    public function password()
    {
        $has_password = !empty($this->request->user()->password);

        return view($this->view, compact('has_password'));
    }

    public function passwordPut(Hasher $hash)
    {
        $user = $this->request->user();
        $has_password = !empty($user->password);

        $this->validate($this->request, [
            'password' => $has_password ? 'required' : '',
            'new_password' => 'required|min:6',
        ]);

        if ($has_password && !$hash->check($this->request->input('password'), $user->password)) {
            return back()->withErrors(['password' => 'Неверно введен текущий пароль']);
        }

        $user->password = $this->request->input('new_password');
        $user->save();

        event(new \App\Events\Stats\MyPasswordChanged);

        return back()->with('message', trans('my.saved'));
    }

    public function profile()
    {
        return view($this->view);
    }

    public function profilePut()
    {
        $user = $this->request->user();

        $this->validate($this->request, [
            'mail' => 'empty',
            'username' => [
                'min:2',
                'max:32',
                'alpha_dash',
                Rule::unique('users', 'login')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:125',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->login = $this->request->input('username');
        $user->email = $this->request->input('email');
        $user->save();

        event(new \App\Events\Stats\MyProfileChanged);

        return back()->with('message', trans('my.saved'));
    }

    public function settings()
    {
        return view($this->view);
    }

    public function settingsPut()
    {
        $this->validate($this->request, [
            'mail' => 'empty',
            'theme' => [
                'required',
                Rule::in([User::THEME_LIGHT, User::THEME_DARK])
            ],
            'torrent_short_title' => 'in:0,1',
        ]);

        $user = $this->request->user();

        $user->theme = $this->request->input('theme', User::THEME_LIGHT);
        $user->torrent_short_title = $this->request->input('torrent_short_title', 0);
        $user->save();

        event(new \App\Events\Stats\MySettingsChanged);

        return back()->with('message', trans('my.saved'));
    }
}

<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Validation\Rule;

class MySettings extends Controller
{
    public function edit()
    {
        return view('my.settings');
    }

    public function update()
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

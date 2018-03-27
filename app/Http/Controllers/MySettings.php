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
        request()->validate([
            'theme' => [
                'required',
                Rule::in([User::THEME_LIGHT, User::THEME_DARK]),
            ],
            'locale' => Rule::in(array_keys(config('cfg.locales'))),
            'notify_gigs' => 'in:0,1',
            'notify_news' => 'in:0,1',
            'notify_trips' => 'in:0,1',
            'torrent_short_title' => 'in:0,1',
        ]);

        /* @var User $user */
        $user = request()->user();

        $user->theme = request('theme', User::THEME_LIGHT);
        $user->locale = request('locale');
        $user->notify_gigs = request('notify_gigs', User::NOTIFY_NO);
        $user->notify_news = request('notify_news', User::NOTIFY_NO);
        $user->notify_trips = request('notify_trips', User::NOTIFY_NO);
        $user->torrent_short_title = request('torrent_short_title', 0);
        $user->save();

        event(new \App\Events\Stats\MySettingsChanged);

        return back()->with('message', trans('my.saved'));
    }
}

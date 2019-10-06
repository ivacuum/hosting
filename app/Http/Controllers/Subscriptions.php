<?php namespace App\Http\Controllers;

use App\Mail\SubscriptionConfirm;
use App\Rules\Email;
use App\User;
use Illuminate\Contracts\Encryption\DecryptException;

class Subscriptions extends Controller
{
    public function confirm()
    {
        /** @var User $user */
        $user = request()->user();
        $hash = request('hash');

        try {
            $subscriptions = array_flip(explode(',', \Crypt::decryptString($hash)));
        } catch (DecryptException $e) {
            return redirect(path([MySettings::class, 'edit']))
                ->with('message', 'Запрос не найден. Измените настройки уведомлений вручную на этой странице.');
        }

        if (isset($subscriptions['gigs'])) {
            $user->notify_gigs = User::NOTIFY_MAIL;
        }

        if (isset($subscriptions['news'])) {
            $user->notify_news = User::NOTIFY_MAIL;
        }

        if (isset($subscriptions['trips'])) {
            $user->notify_trips = User::NOTIFY_MAIL;
        }

        $user->save();

        return redirect(path([MySettings::class, 'edit']))
            ->with('message', 'Настройки уведомлений сохранены');
    }

    public function edit()
    {
        if (null !== request()->user()) {
            return redirect(path([MySettings::class, 'edit']));
        }

        return view('subscriptions');
    }

    public function store()
    {
        /** @var User $user */
        $user = request()->user();
        $email = request('email');
        $isGuest = null === $user;

        request()->validate([
            'gigs' => 'in:0,1',
            'news' => 'in:0,1',
            'email' => $isGuest ? Email::rules() : '',
            'trips' => 'in:0,1',
        ]);

        if ($isGuest) {
            $user = (new User)->findByEmailOrCreate([
                'email' => $email,
                'status' => User::STATUS_INACTIVE,
            ]);

            if ($user->wasRecentlyCreated) {
                event(new \App\Events\Stats\UserRegisteredAutoWhenSubscribing);
            } else {
                event(new \App\Events\Stats\UserFoundByEmailWhenSubscribing);
            }
        }

        \Mail::to($user->email)->queue(new SubscriptionConfirm($user, array_keys(array_filter(request(['gigs', 'news', 'trips'])))));

        return redirect(path([self::class, 'edit']))
            ->with('message', 'Теперь необходимо подтвердить подписку по ссылке в письме, которое мы вам отправили.');
    }

    public function update()
    {
        /** @var User $user */
        $user = request()->user();

        if (null !== $value = request('gigs')) {
            $user->notify_gigs = $value ? User::NOTIFY_MAIL : User::NOTIFY_NO;
        } elseif (null !== $value = request('news')) {
            $user->notify_news = $value ? User::NOTIFY_MAIL : User::NOTIFY_NO;
        } elseif (null !== $value = request('trips')) {
            $user->notify_trips = $value ? User::NOTIFY_MAIL : User::NOTIFY_NO;
        }

        $user->save();

        return back()->with('message', 'Настройки уведомлений сохранены');
    }
}

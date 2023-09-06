<?php

namespace App\Http\Controllers;

use App\Action\FindUserByEmailOrCreateAction;
use App\Domain\NotificationDeliveryMethod;
use App\Mail\SubscriptionConfirmMail;
use App\Rules\Email;
use App\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Validation\Rule;

class SubscriptionController
{
    public function confirm()
    {
        /** @var User $user */
        $user = request()->user();
        $hash = request('hash');

        try {
            $subscriptions = array_flip(explode(',', \Crypt::decryptString($hash)));
        } catch (DecryptException) {
            return redirect(path([MySettingsController::class, 'edit']))
                ->with('message', 'Запрос не найден. Измените настройки уведомлений вручную на этой странице.');
        }

        if (isset($subscriptions['gigs'])) {
            $user->notify_gigs = NotificationDeliveryMethod::Mail;
        }

        if (isset($subscriptions['news'])) {
            $user->notify_news = NotificationDeliveryMethod::Mail;
        }

        if (isset($subscriptions['trips'])) {
            $user->notify_trips = NotificationDeliveryMethod::Mail;
        }

        $user->save();

        return redirect(path([MySettingsController::class, 'edit']))
            ->with('message', 'Настройки уведомлений сохранены');
    }

    public function edit()
    {
        if (request()->user()) {
            return redirect(path([MySettingsController::class, 'edit']));
        }

        return view('subscriptions');
    }

    public function store(FindUserByEmailOrCreateAction $findUserByEmailOrCreate)
    {
        /** @var User $user */
        $user = request()->user();
        $email = request('email');
        $isGuest = $user === null;

        request()->validate([
            'gigs' => 'in:0,1',
            'news' => 'in:0,1',
            'email' => Rule::when($isGuest, Email::rules()),
            'trips' => 'in:0,1',
        ]);

        if ($isGuest) {
            $user = $findUserByEmailOrCreate->execute(
                $email,
                new \App\Events\Stats\UserRegisteredAutoWhenSubscribing,
                new \App\Events\Stats\UserFoundByEmailWhenSubscribing
            );
        }

        $selectedTopics = array_keys(array_filter(request(['gigs', 'news', 'trips'])));

        \Mail::to($user)
            ->send(new SubscriptionConfirmMail($user, $selectedTopics));

        return redirect(path([self::class, 'edit']))
            ->with('message', __('Теперь необходимо подтвердить подписку по ссылке в письме, которое мы вам отправили.'));
    }

    public function update()
    {
        /** @var User $user */
        $user = request()->user();

        if (null !== $value = request('gigs')) {
            $user->notify_gigs = $value
                ? NotificationDeliveryMethod::Mail
                : NotificationDeliveryMethod::Disabled;
        }

        if (null !== $value = request('news')) {
            $user->notify_news = $value
                ? NotificationDeliveryMethod::Mail
                : NotificationDeliveryMethod::Disabled;
        }

        if (null !== $value = request('trips')) {
            $user->notify_trips = $value
                ? NotificationDeliveryMethod::Mail
                : NotificationDeliveryMethod::Disabled;
        }

        $user->save();

        return back()->with('message', 'Настройки уведомлений сохранены');
    }
}

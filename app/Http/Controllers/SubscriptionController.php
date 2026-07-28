<?php

namespace App\Http\Controllers;

use App\Action\FindUserByEmailOrCreateAction;
use App\Domain\NotificationDeliveryMethod;
use App\Domain\SessionKey;
use App\Http\Requests\SubscriptionConfirmForm;
use App\Http\Requests\SubscriptionStoreForm;
use App\Http\Requests\SubscriptionUpdateForm;
use App\Mail\SubscriptionConfirmMail;
use Illuminate\Contracts\Encryption\DecryptException;

class SubscriptionController
{
    public function confirm(SubscriptionConfirmForm $request)
    {
        $user = $request->user;

        try {
            $subscriptions = array_flip(explode(',', \Crypt::decryptString($request->hash)));
        } catch (DecryptException) {
            return redirect(path([MySettingsController::class, 'edit']))
                ->with(SessionKey::FlashMessage->value, 'Запрос не найден. Измените настройки уведомлений вручную на этой странице.');
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
            ->with(SessionKey::FlashMessage->value, 'Настройки уведомлений сохранены');
    }

    public function edit()
    {
        if (request()->user()) {
            return redirect(path([MySettingsController::class, 'edit']));
        }

        return view('subscriptions');
    }

    public function store(SubscriptionStoreForm $request, FindUserByEmailOrCreateAction $findUserByEmailOrCreate)
    {
        $user = $request->user;
        $isGuest = $user === null;

        if ($isGuest) {
            $user = $findUserByEmailOrCreate->execute(
                $request->email,
                new \App\Events\Stats\UserRegisteredAutoWhenSubscribing,
                new \App\Events\Stats\UserFoundByEmailWhenSubscribing
            );
        }

        \Mail::to($user)
            ->send(new SubscriptionConfirmMail($user, $request->selectedTopics));

        return redirect(path([self::class, 'edit']))
            ->with(SessionKey::FlashMessage->value, __('Теперь необходимо подтвердить подписку по ссылке в письме, которое мы вам отправили.'));
    }

    public function update(SubscriptionUpdateForm $request)
    {
        $user = $request->user;

        if ($request->gigs !== null) {
            $user->notify_gigs = $request->gigs
                ? NotificationDeliveryMethod::Mail
                : NotificationDeliveryMethod::Disabled;
        }

        if ($request->news !== null) {
            $user->notify_news = $request->news
                ? NotificationDeliveryMethod::Mail
                : NotificationDeliveryMethod::Disabled;
        }

        if ($request->trips !== null) {
            $user->notify_trips = $request->trips
                ? NotificationDeliveryMethod::Mail
                : NotificationDeliveryMethod::Disabled;
        }

        $user->save();

        return back()->with(SessionKey::FlashMessage->value, 'Настройки уведомлений сохранены');
    }
}

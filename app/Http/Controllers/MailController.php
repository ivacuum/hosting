<?php

namespace App\Http\Controllers;

use App\Domain\SessionKey;
use App\Email;
use App\Events\MailReported;
use App\Events\Stats\MailClicked;
use App\Events\Stats\MailViewed;
use App\Http\Requests\MailClickForm;
use App\User;
use Illuminate\Contracts\Auth\Guard;

class MailController extends Controller
{
    public function click(MailClickForm $request, Guard $auth, string $timestamp, int $id)
    {
        $email = $request->isSigned
            ? Email::query()->find($id)
            : null;

        if ($email === null) {
            return redirect($request->goto);
        }

        if ($email->hasValidTimestamp($timestamp)) {
            $email->incrementClicks();
        }

        $user = $email->user;

        if ($user !== null) {
            $user->activate();

            if ($user->isActive() && $auth->id() !== $user->id) {
                $auth->login($user);

                event(new \App\Events\Stats\UserAutologinWithEmailLink);
            }
        }

        event(new MailClicked);

        return redirect($request->goto);
    }

    public function report(string $timestamp, int $id)
    {
        /** @var User $user */
        $user = request()->user();

        $email = Email::query()->findOrFail($id);

        abort_if(!$email->hasValidTimestamp($timestamp) || $email->user_id !== $user->id, 404);

        event(new MailReported($email));

        return redirect(path(HomeController::class))
            ->with(SessionKey::FlashMessage->value, __('mail.report_thanks'));
    }

    public function view(string $timestamp, int $id)
    {
        $email = Email::query()->find($id);

        if ($email !== null && $email->hasValidTimestamp($timestamp)) {
            event(new MailViewed($email->id));
        }

        return response()->noContent();
    }
}

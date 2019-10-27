<?php namespace App\Mail;

use App\Http\Controllers\Subscriptions;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class SubscriptionConfirmMail extends Mailable implements ShouldQueue
{
    public $hash;
    public $user;
    public $email;
    public $confirmLink;
    public $subscriptions;

    public function __construct(User $user, array $subscriptions)
    {
        $this->user = $user;
        $this->email = $this->email($user);
        $this->subscriptions = $subscriptions;

        $hash = \Crypt::encryptString(implode(',', $subscriptions));

        $this->confirmLink = $this->email->signedLink(
            path([Subscriptions::class, 'confirm'], ['hash' => $hash])
        );
    }

    public function build()
    {
        return $this->subject(trans('mail.subscription_pending_title'))
            ->markdown('emails.subscription-confirm')
            ->with('locale', $this->locale);
    }

    public function email(User $user)
    {
        return $user->emails()->create([
            'to' => $user->email,
            'locale' => $user->locale,
            'user_id' => $user->id,
            'template' => class_basename(static::class),
        ]);
    }
}

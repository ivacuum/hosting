<?php namespace App\Mail;

use App\Http\Controllers\Subscriptions;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class SubscriptionConfirmMail extends Mailable implements ShouldQueue
{
    use RecordsEmail;

    public $hash;
    public $user;
    public $confirmLink;
    public $subscriptions;

    public function __construct(User $user, array $subscriptions)
    {
        $this->user = $user;
        $this->email = $this->email($user->emails(), $user);
        $this->subscriptions = collect($subscriptions)
            ->map(function ($subscription) {
                return match ($subscription) {
                    'gigs' => __('Концерты'),
                    'news' => __('Новости сайта'),
                    'trips' => __('Путешествия'),
                    default => '',
                };
            })
            ->all();

        $hash = \Crypt::encryptString(implode(',', $subscriptions));

        $this->confirmLink = $this->email->signedLink(
            path([Subscriptions::class, 'confirm'], ['hash' => $hash])
        );
    }

    public function build()
    {
        return $this->subject(__('Подтверждение подписки'))
            ->markdown('emails.subscription-confirm')
            ->with('locale', $this->locale);
    }
}

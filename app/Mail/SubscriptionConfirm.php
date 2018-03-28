<?php namespace App\Mail;

use App\User as Model;
use Illuminate\Mail\Mailable;

class SubscriptionConfirm extends Mailable
{
    public $hash;
    public $email;
    public $model;
    public $subscriptions;

    public function __construct(Model $model, array $subscriptions)
    {
        $this->hash = \Crypt::encryptString(implode(',', $subscriptions));
        $this->model = $model;
        $this->subscriptions = $subscriptions;

        $this->email = $this->email();
    }

    public function build()
    {
        return $this->subject(trans('mail.subscription_pending_title'))
            ->markdown('emails.subscription-confirm');
    }

    public function email()
    {
        return $this->model->emails()->create([
            'to' => $this->model->email,
            'user_id' => $this->model->id,
            'template' => class_basename(static::class),
        ]);
    }
}

<?php namespace App\Mail;

use App\Traits\LocalizedMail;
use App\Trip as Model;
use App\User;
use Illuminate\Mail\Mailable;

class TripPublished extends Mailable
{
    use LocalizedMail;

    public $user;
    public $email;
    public $model;

    public function __construct(Model $model, User $user)
    {
        $this->user = $user;
        $this->model = $model;
        $this->email = $this->email();

        $this->setLocale($user->locale);
    }

    public function build()
    {
        return $this->subject(trans('mail.trip_published_title', ['title' => $this->model->title]))
            ->markdown('emails.trip-published');
    }

    public function email()
    {
        return $this->model->emails()->create([
            'to' => $this->user->email,
            'locale' => $this->user->locale,
            'user_id' => $this->user->id,
            'template' => class_basename(static::class),
        ]);
    }
}

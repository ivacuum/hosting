<?php namespace App\Mail;

use App\Gig as Model;
use App\Traits\LocalizedMail;
use App\User;
use Illuminate\Mail\Mailable;

class GigPublished extends Mailable
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
        return $this->subject(trans('mail.gig_published_title', ['title' => $this->model->title]))
            ->markdown('emails.gig-published');
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

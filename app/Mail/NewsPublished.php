<?php namespace App\Mail;

use App\Traits\LocalizedMail;
use App\News as Model;
use App\User;
use Illuminate\Mail\Mailable;

class NewsPublished extends Mailable
{
    public $user;
    public $email;
    public $model;

    public function __construct(Model $model, User $user)
    {
        $this->user = $user;
        $this->model = $model;
        $this->email = $this->email();
    }

    public function build()
    {
        return $this->subject($this->model->title)
            ->markdown('emails.news-published');
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

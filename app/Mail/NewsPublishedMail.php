<?php namespace App\Mail;

use App\Http\Controllers\MySettings;
use App\News;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class NewsPublishedMail extends Mailable implements ShouldQueue
{
    public $news;
    public $user;
    public $email;
    public $newsLink;
    public $mySettingsLink;

    public function __construct(News $news, User $user)
    {
        $this->news = $news;
        $this->user = $user;
        $this->email = $this->email($news, $user);
        $this->newsLink = $this->email->signedLink($news->www());
        $this->mySettingsLink = $this->email->signedLink(path_locale([MySettings::class, 'edit'], [], false, $user->locale));
    }

    public function build()
    {
        return $this->subject($this->news->title)
            ->markdown('emails.news-published')
            ->with('locale', $this->locale);
    }

    public function email(News $news, User $user)
    {
        return $news->emails()->create([
            'to' => $user->email,
            'locale' => $user->locale,
            'user_id' => $user->id,
            'template' => class_basename(static::class),
        ]);
    }
}

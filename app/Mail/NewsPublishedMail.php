<?php

namespace App\Mail;

use App\Http\Controllers\MySettingsController;
use App\News;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class NewsPublishedMail extends Mailable implements ShouldQueue
{
    use RecordsEmail;

    public $newsLink;
    public $mySettingsLink;

    public function __construct(public News $news, public User $user)
    {
        $this->email = $this->email($news->emails(), $user);
        $this->newsLink = $this->email->signedLink($news->www());
        $this->mySettingsLink = $this->email->signedLink(path_locale([MySettingsController::class, 'edit'], [], false, $user->locale));
    }

    public function build()
    {
        return $this->subject($this->news->title)
            ->markdown('emails.news-published')
            ->with('locale', $this->locale);
    }
}

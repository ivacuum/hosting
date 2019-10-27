<?php namespace App\Mail;

use App\Gig;
use App\Http\Controllers\MySettings;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class GigPublishedMail extends Mailable implements ShouldQueue
{
    public $gig;
    public $email;
    public $gigLink;
    public $mySettingsLink;

    public function __construct(Gig $gig, User $user)
    {
        $this->gig = $gig;
        $this->email = $this->createEmail($gig, $user);
        $this->gigLink = $this->email->signedLink($gig->wwwLocale($user->locale));
        $this->mySettingsLink = $this->email->signedLink(path_locale([MySettings::class, 'edit'], [], false, $user->locale));
    }

    public function build()
    {
        return $this->subject(trans('mail.gig_published_title', ['title' => $this->gig->title]))
            ->markdown('emails.gig-published')
            ->with('locale', $this->locale);
    }

    public function createEmail(Gig $gig, User $user)
    {
        return $gig->emails()->create([
            'to' => $user->email,
            'locale' => $user->locale,
            'user_id' => $user->id,
            'template' => class_basename(static::class),
        ]);
    }
}

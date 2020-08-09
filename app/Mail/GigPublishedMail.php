<?php namespace App\Mail;

use App\Gig;
use App\Http\Controllers\MySettings;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class GigPublishedMail extends Mailable implements ShouldQueue
{
    use RecordsEmail;

    public $gig;
    public $gigLink;
    public $mySettingsLink;

    public function __construct(Gig $gig, User $user)
    {
        $this->gig = $gig;
        $this->email = $this->email($gig->emails(), $user);
        $this->gigLink = $this->email->signedLink($gig->wwwLocale($user->locale));
        $this->mySettingsLink = $this->email->signedLink(path_locale([MySettings::class, 'edit'], [], false, $user->locale));
    }

    public function build()
    {
        return $this->subject(__('mail.gig_published_title', ['title' => $this->gig->title]))
            ->markdown('emails.gig-published')
            ->with('locale', $this->locale);
    }
}

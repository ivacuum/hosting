<?php

namespace App\Mail;

use App\Http\Controllers\MySettingsController;
use App\Trip;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class TripPublishedMail extends Mailable implements ShouldQueue
{
    use RecordsEmail;

    public $tripLink;
    public $mySettingsLink;

    public function __construct(public Trip $trip, User $user)
    {
        $this->email = $this->email($trip->emails(), $user);
        $this->tripLink = $this->email->signedLink($trip->wwwLocale($user->locale));
        $this->mySettingsLink = $this->email->signedLink(path_locale([MySettingsController::class, 'edit'], [], false, $user->locale));

        $this->trip->photos_count ??= $trip->photos()->count();
    }

    public function build()
    {
        return $this->subject(__('mail.trip_published_title', ['title' => $this->trip->title]))
            ->markdown('emails.trip-published')
            ->with('locale', $this->locale);
    }
}

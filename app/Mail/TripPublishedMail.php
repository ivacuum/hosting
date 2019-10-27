<?php namespace App\Mail;

use App\Http\Controllers\MySettings;
use App\Trip;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class TripPublishedMail extends Mailable implements ShouldQueue
{
    public $trip;
    public $email;
    public $tripLink;
    public $mySettingsLink;

    public function __construct(Trip $trip, User $user)
    {
        $this->trip = $trip;
        $this->email = $this->email($trip, $user);
        $this->tripLink = $this->email->signedLink($trip->wwwLocale($user->locale));
        $this->mySettingsLink = $this->email->signedLink(path_locale([MySettings::class, 'edit'], [], false, $user->locale));

        if (!isset($this->trip->photos_count)) {
            $this->trip->photos_count = $trip->photos()->count();
        }
    }

    public function build()
    {
        return $this->subject(trans('mail.trip_published_title', ['title' => $this->trip->title]))
            ->markdown('emails.trip-published')
            ->with('locale', $this->locale);
    }

    public function email(Trip $trip, User $user)
    {
        return $trip->emails()->create([
            'to' => $user->email,
            'locale' => $user->locale,
            'user_id' => $user->id,
            'template' => class_basename(static::class),
        ]);
    }
}

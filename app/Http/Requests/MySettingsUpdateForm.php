<?php namespace App\Http\Requests;

use App\Domain\Locale;
use App\Domain\NotificationDeliveryMethod;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class MySettingsUpdateForm extends AbstractForm
{
    public function authorize(): bool
    {
        return true;
    }

    public function locale()
    {
        return $this->input('locale', Locale::Rus->value);
    }

    public function notifyGigs()
    {
        return NotificationDeliveryMethod::from(
            $this->input('notify_gigs', NotificationDeliveryMethod::Disabled->value)
        );
    }

    public function notifyNews()
    {
        return NotificationDeliveryMethod::from(
            $this->input('notify_news', NotificationDeliveryMethod::Disabled->value)
        );
    }

    public function notifyTrips()
    {
        return NotificationDeliveryMethod::from(
            $this->input('notify_trips', NotificationDeliveryMethod::Disabled->value)
        );
    }

    public function rules(): array
    {
        return [
            'locale' => Rule::in(array_keys(config('cfg.locales'))),
            'notify_gigs' => new Enum(NotificationDeliveryMethod::class),
            'notify_news' => new Enum(NotificationDeliveryMethod::class),
            'notify_trips' => new Enum(NotificationDeliveryMethod::class),
            'torrent_short_title' => 'in:0,1',
        ];
    }

    public function torrentShortTitle()
    {
        return $this->input('torrent_short_title', 0);
    }
}

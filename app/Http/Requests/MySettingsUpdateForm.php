<?php namespace App\Http\Requests;

use App\Domain\Locale;
use App\Domain\NotificationDeliveryMethod;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class MySettingsUpdateForm extends FormRequest
{
    public User $user;
    public readonly int $magnetShortTitle;
    public readonly string $theLocale;
    public readonly NotificationDeliveryMethod $notifyGigs;
    public readonly NotificationDeliveryMethod $notifyNews;
    public readonly NotificationDeliveryMethod $notifyTrips;

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

    protected function passedValidation()
    {
        $this->user = $this->user();
        $this->theLocale = $this->input('locale', Locale::Rus->value);
        $this->magnetShortTitle = $this->input('torrent_short_title', 0);

        $this->notifyGigs = $this->enum('notify_gigs', NotificationDeliveryMethod::class) ?? NotificationDeliveryMethod::Disabled;

        $this->notifyNews = $this->enum('notify_news', NotificationDeliveryMethod::class) ?? NotificationDeliveryMethod::Disabled;

        $this->notifyTrips = $this->enum('notify_trips', NotificationDeliveryMethod::class) ?? NotificationDeliveryMethod::Disabled;
    }
}

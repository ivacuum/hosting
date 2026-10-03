<?php

namespace App\Http\Requests;

use App\Domain\Locale;
use App\Domain\NotificationDeliveryMethod;
use App\Rules\HtmlFormInfrastructureRules;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class MySettingsUpdateForm extends FormRequest
{
    public User $user;
    public readonly int $magnetShortTitle;
    public readonly Locale $theLocale;
    public readonly NotificationDeliveryMethod $notificationDeliveryMethod;

    public function rules(): array
    {
        return [
            ...HtmlFormInfrastructureRules::rules(),
            'locale' => new Enum(Locale::class),
            'notification_delivery_method' => new Enum(NotificationDeliveryMethod::class),
            'magnet_short_title' => 'in:0,1',
        ];
    }

    #[\Override]
    protected function passedValidation()
    {
        $this->user = $this->user();
        $this->theLocale = $this->enum('locale', Locale::class, Locale::Rus);
        $this->magnetShortTitle = $this->input('magnet_short_title', 0);

        $this->notificationDeliveryMethod = $this->enum('notification_delivery_method', NotificationDeliveryMethod::class) ?? NotificationDeliveryMethod::Disabled;
    }
}

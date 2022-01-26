<?php namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class MySettingsUpdateForm extends AbstractForm
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'locale' => Rule::in(array_keys(config('cfg.locales'))),
            'notify_gigs' => 'in:0,1',
            'notify_news' => 'in:0,1',
            'notify_trips' => 'in:0,1',
            'torrent_short_title' => 'in:0,1',
        ];
    }
}

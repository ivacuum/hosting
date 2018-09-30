<?php namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Http\FormRequest;

class MySettingsUpdate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'theme' => Rule::in([User::THEME_LIGHT, User::THEME_DARK]),
            'locale' => Rule::in(array_keys(config('cfg.locales'))),
            'notify_gigs' => 'in:0,1',
            'notify_news' => 'in:0,1',
            'notify_trips' => 'in:0,1',
            'torrent_short_title' => 'in:0,1',
        ];
    }
}

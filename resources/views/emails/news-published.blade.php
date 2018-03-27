@component('mail::message')

{{ trans('mail.news_published', ['title' => $model->title]) }}

@component('mail::button', ['url' => $email->signedLink($model->www())])
{{ trans('mail.read') }}
@endcomponent

@component('mail::button', ['url' => $email->signedLink($model->www().'#comments')])
{{ trans('mail.comment') }}
@endcomponent

@component('mail::button', ['color' => 'light', 'url' => $email->signedLink(path('MySettings@edit'))])
{{ trans('mail.settings') }}
@endcomponent

@include('vendor.mail.html.hit')
@endcomponent

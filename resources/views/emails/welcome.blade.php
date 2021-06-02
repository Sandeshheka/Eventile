@component('mail::message')
# Introduction
Hello {{$name}} sir/madam,

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

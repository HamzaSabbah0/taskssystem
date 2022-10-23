@component('mail::message')
# Greetings

Hi, {{$admin->name}}

@component('mail::panel')
 Welcome in Tasks System
@endcomponent

@component('mail::button', ['url' => 'http://127.0.0.1:8000/cms/admin/login'])
Open CMS
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

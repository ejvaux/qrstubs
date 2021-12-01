{{--<p>Dear {{ $name }},</p>

<p>Please find attached report for {{ $date }}.</p>

<p>Have a nice day!</p>--}}

@component('mail::message')
Dear {{ $name }},

Please find attached transaction report for {{ $date }}.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
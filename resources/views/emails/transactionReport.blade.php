{{--<p>Dear {{ $name }},</p>

<p>Please find attached report for {{ $date }}.</p>

<p>Have a nice day!</p>--}}

@component('mail::message')
{{ $name }},

Please find attached report for {{ $date }}.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
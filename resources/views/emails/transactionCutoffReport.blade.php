@component('mail::message')
Good day!,

Transaction Summary Report for Cutoff for {{ $from }} to {{ $to }}.

@component('mail::table')
| Canteen      | Total Amount Used |
| ----------------- |:--------------------:|
@foreach($ctns as $ctn)
| {{$ctn->name}}     | {{$ctn->transactions_sum}} |
@endforeach
|  Total | {{$ctns->sum('transactions_sum')}} |
@endcomponent

Please find attached file for the List of Transactions.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
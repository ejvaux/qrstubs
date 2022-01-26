@component('mail::message')
Good day!,

Transaction Summary Report for Cutoff {{ $from }} to {{ $to }}.

@component('mail::table')
| Canteen      | Total Credit Used |
| ----------------- |:--------------------:|
@foreach($ctns as $ctn)
| {{$ctn->name}}     | {{$ctn->transactions_sum? $ctn->transactions_sum : 0}} |
@endforeach
@if ($ctns->count() > 1)
|  Total | {{$ctns->sum('transactions_sum')}} |
@endif
@endcomponent

Please find attached file for the List of Transactions.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
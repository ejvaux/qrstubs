@component('mail::message')
Good day!,

Transaction Summary Report for Cutoff {{ $from }} to {{ $to }}.

Control Number: **{{ $ctns[0]->transactions[0]->control_no }}**

@if ($ctns->count() > 1)
@component('mail::table')
| Site | Total Credit | Total Used | Balance |
| :------------: | :----------: | :--------: | :--------: |
| M-site | {{$total_credit}}       | {{$ctns->sum('transactions_sum')}}   | {{$total_credit - $ctns->sum('transactions_sum')}}
@endcomponent
@endif

@component('mail::table')
| Canteen | Credit Used |
| :-----: | :---------: |
@foreach($ctns as $ctn)
@isset($ctn->transactions_sum)
    | {{$ctn->name}}     | {{$ctn->transactions_sum}} |
@endisset
@endforeach
@if ($ctns->count() > 1)
|  Total | {{$ctns->sum('transactions_sum')}} |
@endif
@endcomponent

Please find attached file for the List of Transactions.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
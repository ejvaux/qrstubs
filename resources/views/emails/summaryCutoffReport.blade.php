@component('mail::message')
# CUTOFF SUMMARY REPORT <br><br>

Good Day! <br><br>

Here is the summary report for the cutoff of {{ $from }} to {{ $to }}.
<br>

<b>Total M-Site Credit:   {{ $tcredit }}  </b>

@component('mail::table')
| Canteen      | Total Amount Used |
| ----------------- |:--------------------:|
@foreach($ctns as $ctn)
| {{$ctn->name}}     | {{$ctn->transactions_sum}} |
@endforeach <b>
|  Total | {{$ctns->sum('transactions_sum')}} | </b>
@endcomponent


Please see attached file for the List of Transactions.
<br><br>
Thanks and Best Regards,<br>
{{ config('app.name') }}
@endcomponent
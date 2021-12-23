@component('mail::message')
# CUTOFF SUMMARY REPORT <br><br>

Good Day! <br><br>

Here is the summary report for the cutoff of {{ $from }} to {{ $to }}.
<br>

<b>Total M-Site Credit:   {{ $tcredit }}  </b>
{{-- <!-- @component('mail::table') 
| Cutoff Date       | Canteen 1          | Canteen 2      | Sercomm M-Site Credit | Sercomm M-Site Used
| ----------------- | ------------------ | -------------- | --------------------- | -------------------

@endcomponent -->--}}

@component('mail::table')
| Canteen      | Total Amount Used |
| ----------------- |:--------------------:|
@foreach($ctns as $ctn)
| {{$ctn->name}}     | {{$ctn->transactions_sum}} |
@endforeach
|  Total | {{$ctns->sum('transactions_sum')}} |
@endcomponent


Please see attached file for the List of Transactions.
<br><br>
Thanks and Best Regards,<br>
{{ config('app.name') }}
@endcomponent
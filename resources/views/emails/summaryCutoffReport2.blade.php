@component('mail::message')
# CUTOFF SUMMARY REPORT <br><br>

Good Day! <br><br>

Here is the summary report for the cutoff of {{ $from }} to {{ $to }}.
<br>

@component('mail::table') 
| Cutoff Date       | Chantein Canteen   | Chef Carlos Catering | Sercomm M-Site Credit | Sercomm M-Site Used
| ----------------- | ------------------ | -------------- | --------------------- | -------------------
| {{ $ldate }}      | {{ $tctn1 }}       | {{ $tctn2 }}   | {{ $tcredit }}        | {{ $toverall }}       
@endcomponent


{{-- <div style="overflow-x:auto;">
    <table id="mytable" class="table table-bordred table-striped" style="width:100%;">  
        <thead>
        <tr>  
            <th>Cutoff Date </th>
            <th>Canteen 1</th>
            <th>Canteen 2</th>
            <th>Sercomm M-Site Credit</th>
            <th>Sercomm M-Site Used</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$ldate}}</td>
                <td>{{$tctn1}}</td>
                <td>{{$tctn2}}</td>
                <td>{{$tcredit}}</td>
                <td>{{$toverall}}</td>
            </tr>
        </tbody>
    </table>
</div> --}}
Please see attached file for the List of Transactions.
<br><br>
Thanks and Best Regards,<br>
{{ config('app.name') }}
@endcomponent

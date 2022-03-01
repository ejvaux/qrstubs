@component('mail::message')
Hi {{$name}}!,

Below are the transactions that are changed to confirmed status.

@component('mail::table')

| ID      | Canteen | Price | Scanned At |
| :------: | :------: | :------: | :--------: |
@foreach($transactions as $transaction)
| {{$transaction->id}} | {{$transaction->canteen->name}} | {{$transaction->price}} | {{$transaction->created_at}} |
@endforeach

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
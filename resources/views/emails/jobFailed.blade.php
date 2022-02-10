@component('mail::message')
# FAILED JOB REPORT <br><br>

{{$jobs->payload}}

{{--@component('mail::table')
| Exception      | Failed at |
| ----------------- |:--------------------:|
@foreach($jobs as $job)
| {{$job->exception}}     | {{$job->failed_at}} |
{{json_decode($job->payload)}}
@endforeach

@endcomponent--}}

@endcomponent
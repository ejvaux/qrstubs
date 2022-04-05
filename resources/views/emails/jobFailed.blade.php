@component('mail::message')
# FAILED JOB REPORT

@component('mail::table')
| Task | Details | Failed at |
| ----------------- | -------------------- | -------------------- |
@foreach($jobs as $job)
| {{json_decode($job->payload)->displayName}}  | [View]({{ url('/jobs/failed/payload/view/'.$job->id) }}) | {{$job->failed_at}} |
@endforeach

@endcomponent

@endcomponent
@component('mail::message')
    <h4>{{$message}}</h4>
    <h5>أسم المشروع : {{$project->title}}</h5>
    <br>
    {{ config('app.name') }}
@endcomponent


@extends('emails.layout')


@section('header_title')
🚀 Monitor Up Alert
@endsection

@section('content')
<p style="margin-top: 0;">Hello,{{$monitor->name}}</p>
{{-- <p style="margin-top: 0;">Hello, {{ $monitor->user->name }}</p> --}}
<p>
    <strong style="color:#38c172;">{{ $monitor->url }}</strong> 
    is currently <strong>UP</strong> as of <strong>{{ now() }}</strong>.
</p>
<p>The service is operating normally. No action is required at this time.</p>
@endsection




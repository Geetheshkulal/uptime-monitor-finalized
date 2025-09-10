@extends('emails.layout')

@section('title', 'Monitor Down Alert - DRISHTI PULSE')

{{-- @section('tracking')
    <div style="display:none; font-size:0; line-height:0;">
        <img src="{{ url('/track/' . $token . '.png') }}" 
             alt="" width="1" height="1"
             style="display:block;width:1px;height:1px;border:0;">
    </div>
@endsection --}}

@section('header_title')
    ⚠️ Monitor Down Alert
@endsection

@section('content')
<p>Hello, {{ $monitor->name }}</p>
{{-- <p>Hello, {{ $monitor->user->name }}</p> --}}
<p>We have detected that <strong style="color:var(--primary-color);">{{ $monitor->url }}</strong> is currently <strong>DOWN</strong>.</p>
<p>We will notify you once the monitor is back <strong>UP</strong>.</p>

<div style="background-color: #f8f9fa; border-left: 4px solid #3490dc; padding: 15px; margin: 30px 0; border-radius: 4px;">
    <li><strong>Monitor Name:</strong> {{ $monitor->name }}</li>
    <li><strong>URL:</strong> {{ $monitor->url }}</li>
    <li><strong>Cause:</strong> {{ $reason }}</li>
    <li><strong>Last Checked:</strong> {{ now() }}</li>
</div>
@endsection




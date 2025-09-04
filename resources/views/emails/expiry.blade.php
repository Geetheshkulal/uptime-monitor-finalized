@extends('emails.layout')

@section('title', 'SSL Certificate Expiry Alert - DRISHTI PULSE')


@section('header_title')
🔒 SSL Certificate Expiry Alert
@endsection

@section('content')

<p>Hello,</p>
<p>The SSL certificate for <strong style="color:#f6993f;">{{ $site->url }}</strong> will expire on <strong>{{ $site->valid_to }}</strong>.</p>
<p>Please renew the certificate as soon as possible to avoid security warnings and service interruptions.</p>

<div style="background-color: #fef5eb; border-left: 4px solid #f6993f; padding: 15px; margin: 30px 0; border-radius: 4px;">

    <p style="margin: 0 0 10px 0; font-weight: 600;">Certificate Details:</p>
    <ul style="margin: 0; padding-left: 20px;">
        <li>Domain: {{ $site->url }}</li>
        <li>Issuer: {{ $site->issuer }}</li>
        <li>Expiration Date: {{ $site->valid_to }}</li>
    </ul>
</div>
@endsection


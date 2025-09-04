@extends('emails.layout')

@section('title', 'Ticket Raised')

@section('header_title')
Ticket Raised Successfully
@endsection

@section('content')
<p style="margin-top: 0;">Hello <span style="font-weight: 600;">{{ $ticket->user->name ?? 'User' }}</span>,</p>

<p>Thank you for reaching out to us. We’ve successfully received your support ticket. Below are the details:</p>

<div style="background-color: #f8f9fa; border-left: 4px solid #0066cc; padding: 15px; margin: 20px 0; border-radius: 4px;">
    <p style="margin: 0 0 8px 0;"><strong>Subject:</strong> {{ $ticket->title }}</p>
    <p style="margin: 0 0 8px 0;"><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>
    <p style="margin: 0;"><strong>Description:</strong><br>{!! $ticket->message !!}</p>
</div>

<p>Our support team is reviewing your request and will get back to you as soon as possible.</p>

<p>If you have any updates to share, you can reply to this email or track the status via your account dashboard.</p>
@endsection

{{-- <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Raised - {{$ticket->ticket_id}}</title>
</head>
<body style="font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f5f7fa; margin: 0; padding: 0; color: #333333; -webkit-font-smoothing: antialiased;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="min-width: 100%; border-collapse: collapse;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table width="100%" style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                    <!-- Header -->
                    <tr>
                        <td style="text-align: center; background: #3490dc; padding: 30px 20px; border-radius: 12px 12px 0 0;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="vertical-align: middle;">
                                                    <img src="https://i.ibb.co/Fq8LgD9s/mainlogo.png" alt="Logo" style="height: 40px; display: inline-block;">
                                                </td>
                                                <td style="vertical-align: middle; padding-left: 10px;">
                                                    <span style="color: white; font-size: 24px; font-weight: 600;">DRISHTI PULSE</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h1 style="color: white; margin: 20px 0 0 0; font-size: 28px; font-weight: 600;">Ticket Raised Successfully</h1>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px; font-size: 16px; line-height: 1.6;">
                            <p style="margin-top: 0;">Hello <span style="font-weight: 600;">{{ $ticket->user->name ?? 'User' }}</span>,</p>

                            <p>Thank you for reaching out to us. We’ve successfully received your support ticket. Below are the details:</p>

                            <div style="background-color: #f8f9fa; border-left: 4px solid #0066cc; padding: 15px; margin: 20px 0; border-radius: 4px;">
                                <p style="margin: 0 0 8px 0;"><strong>Subject:</strong> {{ $ticket->title }}</p>
                                <p style="margin: 0 0 8px 0;"><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>
                                <p style="margin: 0;"><strong>Description:</strong><br>{!! $ticket->message !!}</p>
                            </div>

                            <p>Our support team is reviewing your request and will get back to you as soon as possible.</p>

                            <p>If you have any updates to share, you can reply to this email or track the status via your account dashboard.</p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 30px; text-align: center; border-radius: 0 0 12px 12px;">
                            <table cellpadding="0" cellspacing="0" border="0" style="margin: 0 auto;">
                                <tr>
                                    <td style="vertical-align: middle;">
                                        <img src="https://i.ibb.co/Fq8LgD9s/mainlogo.png" alt="Logo" style="height: 30px; display: inline-block;">
                                    </td>
                                    <td style="vertical-align: middle; padding-left: 8px;">
                                        <span style="color: #333; font-size: 18px; font-weight: 600;">DRISHTI PULSE</span>
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size: 14px; color: #666; margin: 20px 0 15px 0;">
                                Need help? Email us at <a href="mailto:info@ditsolutions.net" style="color: #0066cc; text-decoration: none;">info@ditsolutions.net</a>
                            </p>

                            <p style="font-size: 13px; color: #999; margin: 0;">
                                &copy; 2025 Drishti Pulse. All rights reserved.
                            </p>

                            <p style="font-size: 12px; color: #999; margin-top: 15px;">
                                You received this email because you raised a support ticket on Drishti Pulse.<br>
                                <a href="#" style="color: #0066cc; text-decoration: none;">Privacy Policy</a> | <a href="#" style="color: #0066cc; text-decoration: none;">Terms of Service</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html> --}}

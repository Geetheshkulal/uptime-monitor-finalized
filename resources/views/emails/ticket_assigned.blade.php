@extends('emails.layout')

@section('title', 'New Ticket Assigned - DRISHTI PULSE')

@section('header_title')
New Ticket Assigned
@endsection

@section('content')
    <p style="margin-top: 0;">Hello <strong>{{ $ticket->assignedUser->name }}</strong>,</p>

    <p>You have been assigned a new ticket. Here are the details:</p>

    <ul style="padding-left: 20px;">
        <li><strong>Ticket ID:</strong> {{ $ticket->ticket_id }}</li>
        <li><strong>Title:</strong> {{ $ticket->title }}</li>
        <li><strong>Priority:</strong> {{ $ticket->priority }}</li>
        <li><strong>Status:</strong> {{ $ticket->status }}</li>
    </ul>

    <p>Please log in to the system to view more details.</p>

    {{-- <div style="text-align: center; margin: 35px 0;">
        <a href="{{ $url }}" style="background: #4f46e5; color: white; text-decoration: none; padding: 14px 30px; border-radius: 6px; font-weight: 600; display: inline-block; box-shadow: 0 3px 6px rgba(0,0,0,0.1); transition: all 0.2s ease;">View Ticket</a>
    </div> --}}

    <p style="margin-bottom: 0;">If you have any questions, feel free to <a href="mailto:info@ditsolutions.net" style="color: #4f46e5; text-decoration: none; font-weight: 500;">contact our support team</a>.</p>
@endsection
{{-- <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Ticket Assigned - DRISHTI PULSE</title>
</head>
<body style="font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f5f7fa; margin: 0; padding: 0; color: #333333; -webkit-font-smoothing: antialiased;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="min-width: 100%; border-collapse: collapse;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table width="100%" style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                    <!-- Header -->
                    <tr>
                        <td style="text-align: center; background: #4f46e5; padding: 30px 20px; border-radius: 12px 12px 0 0;">
                            <table width="100%">
                                <tr>
                                    <td align="center">
                                        <img src="https://i.ibb.co/Fq8LgD9s/mainlogo.png" alt="Logo" style="height: 40px;">
                                        <h1 style="color: white; margin: 10px 0 0 0; font-size: 24px;">New Ticket Assigned</h1>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 40px 30px; font-size: 16px; line-height: 1.6;">
                            <p style="margin-top: 0;">Hello <strong>{{ $ticket->assignedUser->name }}</strong>,</p>

                            <p>You have been assigned a new ticket. Here are the details:</p>

                            <ul style="padding-left: 20px;">
                                <li><strong>Ticket ID:</strong> {{ $ticket->ticket_id }}</li>
                                <li><strong>Title:</strong> {{ $ticket->title }}</li>
                                <li><strong>Priority:</strong> {{ $ticket->priority }}</li>
                                <li><strong>Status:</strong> {{ $ticket->status }}</li>
                            </ul>

                            <p>Please log in to the system to view more details.</p>

                            

                            <p style="margin-bottom: 0;">If you have any questions, feel free to <a href="mailto:info@ditsolutions.net" style="color: #4f46e5; text-decoration: none; font-weight: 500;">contact our support team</a>.</p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 30px; text-align: center; border-radius: 0 0 12px 12px;">
                            <img src="https://i.ibb.co/Fq8LgD9s/mainlogo.png" alt="Logo" style="height: 30px;">
                            <p style="font-size: 14px; color: #666; margin: 15px 0;">
                                &copy; 2025 DRISHTI PULSE. All rights reserved.
                            </p>
                            <p style="font-size: 12px; color: #999; margin-top: 10px;">
                                You received this email because a ticket was assigned to you in Drishti Pulse.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html> --}}

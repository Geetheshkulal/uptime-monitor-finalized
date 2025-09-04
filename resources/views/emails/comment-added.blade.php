
@extends('emails.layout')


@section('header_title')
New Comment Added
@endsection

@section('content')
 <!-- Body -->
 {{-- <tr>
    <td style="padding: 10px 30px 40px 30px; font-size: 16px; line-height: 1.6;"> --}}
        <p style="margin: 0; padding: 0;">Hello <strong>{{ $ticket->user->name }}</strong>,</p>

        <p>A new comment has been added to your ticket <strong>#{{ $ticket->ticket_id }}</strong>:</p>

        <blockquote style="border-left: 4px solid #3490dc; margin: 20px 0; padding-left: 15px; color: #555;">
            {!! $ticket->comments->last()->comment_message !!}
        </blockquote>

        <p>You can view the full ticket and respond using the link below:</p>

        <div style="text-align: center; margin: 35px 0;">
            <a href="{{ $url }}"  style="background: #3490dc; color: white; text-decoration: none; padding: 14px 30px; border-radius: 6px; font-weight: 600; display: inline-block; box-shadow: 0 3px 6px rgba(0,0,0,0.1); transition: all 0.2s ease;">View Ticket</a>
        </div>

        <p style="margin-bottom: 0;">If you have any questions, feel free to <a href="mailto:info@ditsolutions.net" style="color: #0066cc; text-decoration: none; font-weight: 500;">contact our support team</a>.</p>
    {{-- </td>
</tr> --}}
@endsection




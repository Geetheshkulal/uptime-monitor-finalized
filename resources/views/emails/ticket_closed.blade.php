<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Closed - {{$ticket->ticket_id}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body style="font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f5f7fa; margin: 0; padding: 0; color: #333333; -webkit-font-smoothing: antialiased;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="min-width: 100%; border-collapse: collapse;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table width="100%" style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                    <!-- Header -->
                    <tr>
                       <td style="text-align: center; background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); padding: 40px 20px; border-radius: 12px 12px 0 0;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center">
                                        <div style="background-color: white; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                            <i class="fas fa-check-circle" style="font-size: 40px; color: #10b981;"></i>
                                        </div>
                                        <h1 style="color: white; margin: 0; font-size: 28px; font-weight: 600;">Ticket Closed</h1>
                                        <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0; font-size: 16px;">Your support request has been resolved</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px; font-size: 16px; line-height: 1.6;">
                            <p style="margin-top: 0;">Hello <span style="font-weight: 600; color: #4f46e5;">{{ $ticket->user->name ?? 'User' }}</span>,</p>

                            <p>We're pleased to inform you that your support ticket has been successfully resolved and closed. Below are the details for your reference:</p>

                            <div style="background-color: #f8f9fa; border-radius: 8px; padding: 20px; margin: 25px 0; border: 1px solid #e5e7eb;">
                                <div style="display: flex; align-items: center; margin-bottom: 15px;">
                                    <div style="background-color: #e0e7ff; width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">
                                        <i class="fas fa-ticket-alt" style="color: #4f46e5; font-size: 18px;"></i>
                                    </div>
                                    <div>
                                        <h3 style="margin: 0 0 5px 0; font-size: 18px; color: #111827;">Ticket Summary</h3>
                                        <p style="margin: 0; color: #6b7280; font-size: 14px;">Reference # {{ $ticket->ticket_id }}</p>
                                    </div>
                                </div>
                                
                                <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                    <tr>
                                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; width: 30%; color: #6b7280;">Subject</td>
                                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; font-weight: 500;">{{ $ticket->title }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; color: #6b7280;">Priority</td>
                                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; font-weight: 500;">
                                            <span style="display: inline-flex; align-items: center;">
                                                @if($ticket->priority == 'high')
                                                    <i class="fas fa-circle" style="color: #ef4444; font-size: 8px; margin-right: 6px;"></i>
                                                @elseif($ticket->priority == 'medium')
                                                    <i class="fas fa-circle" style="color: #f59e0b; font-size: 8px; margin-right: 6px;"></i>
                                                @else
                                                    <i class="fas fa-circle" style="color: #10b981; font-size: 8px; margin-right: 6px;"></i>
                                                @endif
                                                {{ ucfirst($ticket->priority) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; color: #6b7280;">Description</td>
                                        <td style="padding: 8px 0; font-weight: 500;">{!! $ticket->message !!}</td>
                                    </tr>
                                </table>
                            </div>

                            <div style="background-color: #f0fdf4; border-radius: 8px; padding: 20px; margin: 30px 0; text-align: center; border: 1px solid #d1fae5;">
                                <i class="fas fa-comment-dots" style="color: #10b981; font-size: 24px; margin-bottom: 10px;"></i>
                                <h3 style="margin: 10px 0; color: #065f46;">Was this helpful?</h3>
                                <p style="margin: 0 0 15px 0; color: #047857;">We'd love to hear your feedback about your support experience</p>
                                <a href="{{ url('/') }}" style="display: inline-block; background-color: #10b981; color: white; text-decoration: none; padding: 10px 20px; border-radius: 6px; font-weight: 500; font-size: 14px;">Share Feedback</a>
                            </div>

                            <p style="margin-bottom: 25px;">If you need further assistance, please don't hesitate to create a new ticket through your dashboard.</p>
                            
                            <a href="{{ url('/') }}" style="display: inline-block; background-color: #4f46e5; color: white; text-decoration: none; padding: 12px 24px; border-radius: 6px; font-weight: 500; margin-top: 10px;">Go to Dashboard</a>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; padding: 30px; text-align: center; border-radius: 0 0 12px 12px; border-top: 1px solid #e5e7eb;">
                            <img src="https://i.ibb.co/Fq8LgD9s/mainlogo.png" alt="Logo" style="height: 30px; margin-bottom: 15px;">
                            
                            <div style="margin: 20px 0;">
                                <a href="#" style="display: inline-block; margin: 0 8px;"><i class="fab fa-facebook-f" style="color: #4f46e5;"></i></a>
                                <a href="#" style="display: inline-block; margin: 0 8px;"><i class="fab fa-twitter" style="color: #4f46e5;"></i></a>
                                <a href="#" style="display: inline-block; margin: 0 8px;"><i class="fab fa-linkedin-in" style="color: #4f46e5;"></i></a>
                                <a href="#" style="display: inline-block; margin: 0 8px;"><i class="fab fa-instagram" style="color: #4f46e5;"></i></a>
                            </div>

                            <p style="font-size: 14px; color: #6b7280; margin: 15px 0; line-height: 1.5;">
                                <a href="mailto:drishtipulse2025@gmail.com" style="color: #4f46e5; text-decoration: none;">drishtipulse2025@gmail.com</a><br>
                                Drishti Pulse Support Team
                            </p>

                            <p style="font-size: 12px; color: #9ca3af; margin: 20px 0 0 0; line-height: 1.5;">
                                &copy; 2025 Drishti Pulse. All rights reserved.<br>
                                <a href="#" style="color: #6b7280; text-decoration: none;">Privacy Policy</a> | 
                                <a href="#" style="color: #6b7280; text-decoration: none;">Terms of Service</a><br>
                                <em style="color: #9ca3af;">This is an automated message. Please do not reply.</em>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
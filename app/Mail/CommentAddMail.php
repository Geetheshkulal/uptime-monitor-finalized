<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Drivers\Gd\Modifiers\RotateModifier;

class CommentAddMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Comment Added to Your Ticket',
        );
    }

    public function content(): Content
    {
        $url = route('display.tickets.show', $this->ticket->id);

        return new Content(
            view: 'emails.comment-added',
            with: [
                'ticket' => $this->ticket,
                'url' => $url,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

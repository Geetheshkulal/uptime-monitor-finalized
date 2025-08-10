<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class InvoiceEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $pdfPath,
        public mixed $user,
        public mixed $payment
    ) {}

    public function build()
    {
        return $this->subject('Your Invoice #' . $this->payment->payment_id)
                   ->view('emails.invoice')
                   ->with([
                       'user' => $this->user,
                       'payment' => $this->payment
                   ]);
    }

    public function attachments()
    {
        return [
            Attachment::fromPath(public_path($this->pdfPath))
                ->as('invoice.pdf')
                ->withMime('application/pdf'),
            // Attachment::fromStorage($this->pdfPath)
            //           ->as('invoice.pdf')
            //           ->withMime('application/pdf'),
        ];
    }
}
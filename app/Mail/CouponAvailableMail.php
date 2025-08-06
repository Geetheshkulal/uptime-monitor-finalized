<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class CouponAvailableMail extends Mailable
{
    use Queueable, SerializesModels;

    public $coupon;
    public $user;

    public function __construct($coupon, $user)
    {
        $this->coupon = $coupon;
        $this->user = $user;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎉 New Coupon Just for You!',
        );
    }

    public function content(): Content
    {
        $url = route('premium.page');

        return new Content(
            view: 'emails.coupon-available',
            with: [
                'coupon' => $this->coupon,
                'user' => $this->user,
                'url' => $url,
            ],
        );
    }

    // public function build()
    // {
    //     $url = route('premium.page');

    //     return $this->subject('🎉 New Coupon Just for You!')
    //                 ->view('emails.coupon-available')
    //                 ->with([
    //                     'coupon' => $this->coupon,
    //                     'user' => $this->user,
    //                     'url' => $url,
    //                 ]);
    // }
}

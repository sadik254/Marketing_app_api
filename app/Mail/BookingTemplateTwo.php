<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;
use App\Models\Company;

class BookingTemplateTwo extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $company;

    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
        $this->company = Company::first(); // Fetch single company record
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Booking Confirmation')
                    ->view('emails.booking_template_two');
    }
}

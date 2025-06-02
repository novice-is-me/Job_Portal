<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class RejectionEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
     public $applicantName;
     public $interviewDate;
     public $jobName;
    public function __construct($applicantName, $interviewDate, $jobName)
    {
        //
        $this->applicantName = $applicantName;
        $this->interviewDate = $interviewDate;
        $this->jobName = $jobName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('jobportal@mail.com', 'JobConnect'),
            subject: 'Interview Rejection Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.rejection_email',
            with: [
                'applicantName' => $this->applicantName,
                'interviewDate' => $this->interviewDate,
                'jobName' => $this->jobName,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

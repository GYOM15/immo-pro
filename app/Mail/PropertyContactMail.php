<?php

namespace App\Mail;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PropertyContactMail extends Mailable
{
    use Queueable, SerializesModels;



    // Propriétés privées pour stocker les données sensibles
    private $property;
    private $data;

    /**
     * Create a new message instance.
     *
     * @param Property $property
     * @param array $data
     * @return void
     */
    public function __construct(Property $property, array $data)
    {
        $this->property = $property;
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: ['calebkoffi21@gmail.com'],
            replyTo : $this->data['email'],
        );
    }

    public function build()
    {
        return $this->from($this->data['email'])
                    ->subject('Property Contact Mail')
                    ->view('emails.property.contact', [
                        'property' => $this->property,
                        'data' => $this->data,
                    ]);
    }

    
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // On peut remplacer par html(pour le format html) ou par text(pour le format text)
        return new Content(
            markdown: 'emails.property.contact',
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

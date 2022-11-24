<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use App\Models\Product;

class ProductCommented extends Mailable
{
    use Queueable;

    public function __construct(
        protected Product $product,
    ) {}

    public function envelope()
    {
        return new Envelope(
            subject: 'Novo comentário inserido',
        );
    }

    public function content()
    {
        return new Content(
            markdown: 'mails.comments',
            with: [
                'product' => $this->product
            ]
        );
    }

    public function attachments()
    {
        return [];
    }
}

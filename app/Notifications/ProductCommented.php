<?php

namespace App\Notifications;

use App\Models\CommentProduct;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductCommented extends Notification
{
    use Queueable;

    public function __construct(
        protected Product $product,
        protected CommentProduct $comment,
    ) {}

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject("Novo comentário para o produto {$this->product->name}")
                    ->line($this->comment->description)
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

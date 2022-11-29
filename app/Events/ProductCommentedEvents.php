<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Product;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductCommentedEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        private Product $product
    ) { }

    public function getProduct()
    {
        return $this->product;
    }
    
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

<?php

namespace App\Listeners;

use App\Events\ProductCommentedEvents;
use App\Mail\ProductCommented;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailProductCommented
{
    public function __construct()
    {
        //
    }

    public function handle(ProductCommentedEvents $event)
    {
        $product = $event->getProduct();
        $user = $product->user;

        Mail::to($user->email)
            ->queue(new ProductCommented($product));
    }
}

<?php

namespace App\Listeners;

use App\Events\TicketSold;
use App\Payment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreTicketInformation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TicketSold  $event
     * @return void
     */
    public function handle(TicketSold $event)
    {
        $lar_event = $event;
        $eventile_event = $lar_event->event;
        $eventile_event->decrement('ticket_remaining',$lar_event->ticket_count);
        $eventile_event->tickets()->create([
            'user_id' => auth()->id(),
            'ticket_count'=> $lar_event->ticket_count
        ]);
        $eventile_event->payments()->save(new Payment([
            'payment_id' => $lar_event->payment_id,
            'amount' => $lar_event->amount,
            'user_id' =>auth()->id(),
        ]));
    }
}

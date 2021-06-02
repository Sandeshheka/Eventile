<?php

namespace App\Http\Controllers;

use App\Event;
use App\Events\TicketSold;
use App\Http\Resources\PaymentResource;
use App\Notifications\TicketPurchased;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function index()
    {
        $payments = auth()->user()->payments;
        return PaymentResource::collection($payments);
    }
    public function pay(Request $request, Event $event)
    {
        $amount = $event->ticket_price * 100;
       
        $payment =auth()->user()->charge($amount, $request->paymentMethod['id'],[
            'description' => "Payment for event $event->id"
        ]);
        event(new TicketSold($event, $request->ticket_count,$amount, $payment->id));
        auth()->user()->notify(new TicketPurchased());
        return response("done");
    }
}

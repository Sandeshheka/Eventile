<?php

namespace App\Http\Controllers;

use App\Http\Resources\TicketResource;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = auth()->user()->tickets;
        return TicketResource::collection($tickets);
    }
}

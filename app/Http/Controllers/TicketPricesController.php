<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Order;
use Illuminate\Http\Request;

class TicketPricesController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return view('ticket-prices', ['tickets' => $tickets]);
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'tickets' => 'required|array',
            'tickets.*' => 'integer|min:0',
        ]);

        if (array_sum($request->tickets) < 1) {
            return back()->with('message', 'Please order at least one ticket');
        }

        $order = new Order;
        $order->email = $request->email;
        $order->tickets = json_encode($request->tickets);
        $order->save();

        return back()->with('message', 'Order placed successfully!');
    }
}

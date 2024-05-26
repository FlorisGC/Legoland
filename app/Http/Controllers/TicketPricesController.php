<?php 
namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TicketPricesController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        $isAuthenticated = Auth::check();
        return view('ticket-prices', ['tickets' => $tickets, 'isAuthenticated' => $isAuthenticated]);
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

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $ticket = Ticket::create($request->all());

        return response()->json($ticket);
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        
        if (Auth::check()) {
            return view('tickets.edit', compact('ticket'));
        } else {
            return redirect()->route('ticket-prices.index')->with('error', 'You must be logged in to edit tickets.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $ticket = Ticket::findOrFail($id);
        
        if (Auth::check()) {
            $ticket->update($request->all());
            return response()->json(['success' => true, 'message' => 'Ticket updated successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'You must be logged in to update tickets.'], 403);
        }
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
            
        if (Auth::check()) {
            $ticket->delete();
            return response()->json(['success' => true, 'message' => 'Ticket deleted successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'You must be logged in to delete tickets.'], 403);
        }
    }
}

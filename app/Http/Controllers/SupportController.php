<?php
// app/Http/Controllers/SupportController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class SupportController extends Controller
{
    public function index()
    {
        // In a real application, we would get the logged-in agent from session
        $agent = [
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'profile_pic' => 'https://ui-avatars.com/api/?name=John+Smith&background=random'
        ];
        
        return view('admin.support.index', compact('agent'));
    }

    public function search(Request $request)
    {
        $term = $request->input('term');
        
        $results = DB::table('airports_bookings')
            ->where('id', 'LIKE', "%$term%")
            ->orWhere('referenceNo', 'LIKE', "%$term%")
            ->orWhere('first_name', 'LIKE', "%$term%")
            ->orWhere('last_name', 'LIKE', "%$term%")
            ->orWhere('email', 'LIKE', "%$term%")
            ->orWhere('phone_number', 'LIKE', "%$term%")
            ->orWhere('registration', 'LIKE', "%$term%")
            ->orWhere('make', 'LIKE', "%$term%")
            ->orWhere('model', 'LIKE', "%$term%")
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();
            
        return response()->json($results);
    }
    
    public function fetch($id)
    {
        $result = DB::table('airports_bookings')
            ->where('id', $id)
            ->first();
    
        return response()->json($result);
    }


    public function update_old(Request $request, $id)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'phone_number' => 'required|string|max:100',
            'departDate' => 'required|date',
            'returnDate' => 'required|date',
            'make' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'registration' => 'nullable|string|max:255',
        ]);
        
        DB::table('airports_bookings')
            ->where('id', $id)
            ->update($data);
            
        return response()->json(['success' => true]);
    }
    
    public function updateBooking(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:airports_bookings,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'make' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'registration' => 'nullable|string|max:50',
            'departDate' => 'nullable|date',
            'deprTerminal' => 'nullable|string|max:50',
            'deptFlight' => 'nullable|string|max:50',
            'returnDate' => 'nullable|date',
            'returnTerminal' => 'nullable|string|max:50',
            'returnFlight' => 'nullable|string|max:50',
            'booking_amount' => 'nullable|numeric',
            'discount_amount' => 'nullable|numeric',
            'total_amount' => 'nullable|numeric',
            'payment_method' => 'nullable|string|max:50',
            'payment_status' => 'nullable|string|max:50',
            'refund_status' => 'nullable|string|max:50',
        ]);
    
        DB::table('airports_bookings')
            ->where('id', $validated['id'])
            ->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'country' => $validated['country'],
                'postal_code' => $validated['postal_code'],
                'make' => $validated['make'],
                'model' => $validated['model'],
                'color' => $validated['color'],
                'registration' => $validated['registration'],
                'departDate' => $validated['departDate'],
                'deprTerminal' => $validated['deprTerminal'],
                'deptFlight' => $validated['deptFlight'],
                'returnDate' => $validated['returnDate'],
                'returnTerminal' => $validated['returnTerminal'],
                'returnFlight' => $validated['returnFlight'],
                'booking_amount' => $validated['booking_amount'],
                'discount_amount' => $validated['discount_amount'],
                'total_amount' => $validated['total_amount'],
                'payment_method' => $validated['payment_method'],
                'payment_status' => $validated['payment_status'],
                'refund_status' => $validated['refund_status'],
                'updated_at' => now(),
            ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Booking updated successfully.'
        ]);
    }
    
    public function reschedule(Request $request, $id)
    {
        $request->validate([
            'departDate'      => 'required|date',
            'returnDate'      => 'required|date|after_or_equal:departDate',
            'deprTerminal'    => 'nullable|string|max:100',
            'returnTerminal'  => 'nullable|string|max:100',
            'deptFlight'      => 'nullable|string|max:100',
            'returnFlight'    => 'nullable|string|max:100',
            'rescheduleReason'=> 'nullable|string|max:255',
            'rescheduleNotes' => 'nullable|string',
        ]);
    
        // Save extra info in browser_data as JSON
        $extraNotes = [
            'reason' => $request->rescheduleReason,
            'notes'  => $request->rescheduleNotes,
        ];
    
        $updated = DB::table('airports_bookings')
            ->where('id', $id)
            ->update([
                'departDate'     => $request->departDate,
                'returnDate'     => $request->returnDate,
                'deprTerminal'   => $request->deprTerminal,
                'returnTerminal' => $request->returnTerminal,
                'deptFlight'     => $request->deptFlight,
                'returnFlight'   => $request->returnFlight,
                'browser_data'   => json_encode($extraNotes),
                'modifydate'     => now()
            ]);
    
        return response()->json([
            'status'  => $updated ? 'success' : 'error',
            'message' => $updated ? 'Booking rescheduled successfully' : 'No changes made',
        ]);
    }

    public function cancelBooking(Request $request, $id)
    {
        $booking = DB::table('airports_bookings')->find($id);
        
        // Update booking status
        DB::table('airports_bookings')
            ->where('id', $id)
            ->update([
                'booking_status' => 'Cancelled',
                'booking_action' => 'Cancelled',
                'modifydate' => now()
            ]);
            
        return response()->json(['success' => true]);
    }

    public function changeDates(Request $request, $id)
    {
        $request->validate([
            'departDate' => 'required|date',
            'returnDate' => 'required|date',
            'deprTerminal' => 'nullable|string|max:100',
            'returnTerminal' => 'nullable|string|max:100',
            'deptFlight' => 'nullable|string|max:100',
            'returnFlight' => 'nullable|string|max:100',
        ]);
        
        DB::table('airports_bookings')
            ->where('id', $id)
            ->update($request->only([
                'departDate', 'returnDate', 
                'deprTerminal', 'returnTerminal',
                'deptFlight', 'returnFlight'
            ]));
            
        return response()->json(['success' => true]);
    }

    public function processRefund(Request $request, $id)
    {
        $request->validate([
            'refund_amount' => 'required|numeric',
            'refund_reason' => 'required|string|max:255'
        ]);
        
        // In a real application, we would integrate with payment gateway
        DB::table('airports_bookings')
            ->where('id', $id)
            ->update([
                'refund_status' => 'Processed',
                'booking_status' => 'Refund',
                'modifydate' => now()
            ]);
            
        return response()->json(['success' => true]);
    }

    public function resendEmail($id)
    {
        $booking = DB::table('airports_bookings')->find($id);
        
        // In a real application, we would send the email here
        // For now, we'll just update the status
        DB::table('airports_bookings')
            ->where('id', $id)
            ->update(['email_status' => 'Yes']);
            
        return response()->json(['success' => true]);
    }
}
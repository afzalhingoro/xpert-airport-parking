<?php

namespace App\Http\Controllers;

use App\Models\airports_bookings;
use App\Models\TemporaryBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function receivePayment(Request $request)
    {
        $responseData = json_decode($request->getContent(), true); // Use getContent() to get the request body as JSON.
        // Check if the necessary keys exist before accessing them
        if (isset($responseData['data']['object']['metadata']['booking_id'])) {
            $bookingId = $responseData['data']['object']['metadata']['booking_id'];
            $uniqueId = $responseData['data']['object']['metadata']['unique_id'];
        } else {
            $bookingId = null; // Set a default value or handle the absence of data.
        }
        if (isset($responseData['data']['object']['payment_status'])) {
            $paymentStatus = $responseData['data']['object']['payment_status'];
        } else {
            $paymentStatus = null; // Set a default value or handle the absence of data.
        }

        $booking = airports_bookings::find($bookingId);
        if ($booking) {
            $tem_booking = TemporaryBooking::where('booking_id', $booking->id)->where('unique_identifier', $uniqueId)->first();
            $booking->departDate =  $tem_booking->departure_date_time;
            $booking->returnDate =  $tem_booking->return_date_time;
            $booking->discount_code =  $tem_booking->promo_code;
            if ($tem_booking->is_refund = false) {
                $booking->total_amount =  ($booking->total_amount + $tem_booking->price_difference);
            }
            $booking->save();
            Log::info("Booking Dates Changed Suucessfully");
        } else {
            Log::info("Booking ID: " . $bookingId . 'Booking Not Found Error');
            Log::info("Payment Status: " . $paymentStatus . 'Payment null or Not Found');
        }
    }
}

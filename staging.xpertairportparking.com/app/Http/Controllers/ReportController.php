<?php

namespace App\Http\Controllers;

use App\Models\airports_bookings;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{


    public function last_working_generateCapacityReport(Request $request)
    {
        $report = [];

        if ($request->has('from_date') && $request->has('to_date')) {
            $fromDate = Carbon::createFromFormat('Y-m-d', $request->input('from_date'));
            $toDate = Carbon::createFromFormat('Y-m-d', $request->input('to_date'));

            $bookings = airports_bookings::where(function ($query) use ($fromDate, $toDate) {
                $query->where(function ($query) use ($fromDate, $toDate) {
                    $query->whereDate('departDate', '>=', $fromDate)->whereDate('departDate', '<=', $toDate);
                })->orWhere(function ($query) use ($fromDate, $toDate) {
                    $query->whereDate('returnDate', '>=', $fromDate)->whereDate('returnDate', '<=', $toDate);
                });
            })->get();

            $currentDate = $fromDate;
            $parkingCapacity = 500;

            while ($currentDate <= $toDate) {
                $carInRegNumber = '-';
                $carOutRegNumber = '-';
                $returns = 0;

                foreach ($bookings as $booking) {
                    $departDate = Carbon::createFromFormat('Y-m-d H:i:s', $booking->departDate);
                    $returnDate = Carbon::createFromFormat('Y-m-d H:i:s', $booking->returnDate);

                    if ($departDate->format('Y-m-d') <= $currentDate->format('Y-m-d') && $returnDate->format('Y-m-d') >= $currentDate->format('Y-m-d')) {
                        $carInRegNumber =   $booking->referenceNo  . '|created_at ' . $booking->created_at  . '| ' .  $booking->id . '| departDate ' .  $booking->departDate . '| returnDate ' .  $booking->returnDate;
                    } elseif ($returnDate->format('Y-m-d') == $currentDate->format('Y-m-d')) {
                        $carOutRegNumber =  $booking->referenceNo  . '| ' .  $booking->id;
                    }
                }

                $parkingCapacity = max(0, $parkingCapacity - $returns);

                $entry = [
                    'date' => $currentDate->format('Y-m-d'),
                    'car_in_reg_number' => $carInRegNumber . ',',
                    'car_out_reg_number' => $carOutRegNumber,
                    'capacity_count' => $parkingCapacity,
                ];

                $report[] = $entry;

                $currentDate->addDay();
            }
        }
        return view('admin.reports.capacity', ['bookings' => $report]);
    }

    public function generateCapacityReport(Request $request)
    {

        $bookingDetails = [];
        if ($request->has('from_date') && $request->has('to_date')) {
            $fromDate = Carbon::createFromFormat('Y-m-d', $request->input('from_date'));
            $toDate = Carbon::createFromFormat('Y-m-d', $request->input('to_date'));


            $reportData = DB::table('airports_bookings')
                ->select(
                    DB::raw('DATE(created_at) as date'),
                    DB::raw('SUM(DATEDIFF(returnDate, departDate) + 1) as pickups'),
                    DB::raw('SUM(DATEDIFF(returnDate, departDate) + 1) as returns')
                )
                ->whereBetween(DB::raw('DATE(created_at)'), [$fromDate, $toDate])
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy(DB::raw('DATE(created_at)'))
                ->get();



            // Calculate the capacity
            $previousCapacity = 500;
            foreach ($reportData as $data) {
                $data->capacity = $previousCapacity;
                $previousCapacity = $previousCapacity - $data->pickups + $data->returns;
            }

            dd($reportData);
        }



        // Pass the modified $bookingDetails to the view
        return view('admin.reports.capacity', ['bookingDetails' => $bookingDetails]);
    }



    public function lasrtgenerateCapacityReport(Request $request)
    {
        $report = [];
        $capacity = '';
        if ($request->has('from_date') && $request->has('to_date')) {
            $fromDate = Carbon::createFromFormat('Y-m-d', $request->input('from_date'));
            $toDate = Carbon::createFromFormat('Y-m-d', $request->input('to_date'));
            $dates = [];
            for ($date = $fromDate; $date->lte($toDate); $date->addDay()) {
                $dates[] = $date->toDateString();
            }
            $cap = $this->getAvailableParkingCapacity($fromDate, $toDate);

            $capacity = $cap;
            foreach ($dates as $date) {
                $carInCount = airports_bookings::whereDate('departDate', $date)->count();
                $carOutCount = airports_bookings::whereDate('returnDate', $date)->count();

                // Initialize counts to 0 if no matching records found
                $carInCount = max(0, $carInCount);
                $carOutCount = max(0, $carOutCount);

                // Calculate the new capacity considering car in and car out
                $capacity += $carInCount - $carOutCount;

                // Ensure capacity doesn't go below zero or exceed the maximum (500)
                $capacity = max(0, min($capacity, 500));

                $report[] = [
                    'Date' => $date,
                    'CarInCount' => $carInCount,
                    'CarOutCount' => $carOutCount,
                    'CapacityCount' => $capacity,
                ];
            }
        }



        return view('admin.reports.capacity', ['bookings' => $report, 'capacity' => $capacity]);
    }




    public function getAvailableParkingCapacitygenerateCapacityReport(Request $request)
    {
        $report = [];

        if ($request->has('search')) {
            $request->validate([
                'from_date' => 'required|date',
                'to_date' => 'required|date|after_or_equal:from_date',
            ]);
            $fromDate = Carbon::createFromFormat('Y-m-d', $request->input('from_date'));
            $toDate = Carbon::createFromFormat('Y-m-d', $request->input('to_date'));

            $availableCapacity = $this->getAvailableParkingCapacity($fromDate, $toDate);
            dd($availableCapacity);


            $bookings = airports_bookings::where(function ($query) use ($fromDate, $toDate) {
                $query->where(function ($query) use ($fromDate, $toDate) {
                    $query->whereDate('departDate', '>=', $fromDate)
                        ->whereDate('departDate', '<=', $toDate);
                })->orWhere(function ($query) use ($fromDate, $toDate) {
                    $query->whereDate('returnDate', '>=', $fromDate)
                        ->whereDate('returnDate', '<=', $toDate);
                });
            })->get();

            $currentDate = $fromDate;
            $parkingCapacity = 500;

            while ($currentDate <= $toDate) {
                $pickups = 0;
                $returns = 0;

                foreach ($bookings as $booking) {
                    $departDate = Carbon::createFromFormat('Y-m-d H:i:s', $booking->departDate);
                    $returnDate = Carbon::createFromFormat('Y-m-d H:i:s', $booking->returnDate);

                    if ($departDate->format('Y-m-d') <= $currentDate->format('Y-m-d') && $returnDate->format('Y-m-d') >= $currentDate->format('Y-m-d')) {
                        $returns++;
                    } elseif ($departDate->format('Y-m-d') == $currentDate->format('Y-m-d')) {
                        $pickups++;
                    }
                }

                $parkingCapacity = max(0, $parkingCapacity - $pickups);
                $parkingCapacity = min(500, $parkingCapacity + $returns);

                $entry = [
                    'date' => $currentDate->format('Y-m-d'),
                    'parking_capacity' => $parkingCapacity,
                    'pickups' => $pickups,
                    'returns' => $returns,
                ];

                $report[] = $entry;

                $currentDate->addDay();
            }
        }

        return view('admin.reports.capacity', ['bookings' => $report]);
    }

    public function getAvailableParkingCapacity($fromDate, $toDate)
    {



        $bookings = airports_bookings::whereDate('departDate', '<=', $toDate)
            ->whereDate('returnDate', '>', $fromDate)
            ->get();

        $occupiedSpaces = $bookings->count();
        $availableCapacity = 500 - $occupiedSpaces;
        return $availableCapacity;
    }


    public function capacityReport(Request $request)
    {

        $occupancyData = [];
        if ($request->has('from_date') && $request->has('to_date')) {
            $fromDate = $request->from_date; // Replace with user input
            $toDate = $request->to_date;;   // Replace with user input
       
            // Initialize an array to store the occupancy data
            $previousRemainingCapacity = null;
            $capacity = $this->getAvailableParkingCapacity($fromDate, $toDate);
    
            $totalCapacity = $capacity; // Initialize it with the total capacity
            // Convert the date strings to Carbon date objects for easy comparison
             
            
            $startDate = Carbon::createFromFormat('d-M-Y', $fromDate);
            $endDate = Carbon::createFromFormat('d-M-Y', $toDate);


          
            // Loop through the date range
            while ($startDate <= $endDate) {
                $checkDate = $startDate->toDateString();

                // Query the database for check-ins and check-outs on this date
                $checkInCount = airports_bookings::whereDate('departDate', '=', $checkDate)->count();
                $checkOutCount = airports_bookings::whereDate('returnDate', '=', $checkDate)->count();

                // Calculate remaining capacity based on the previous day's remaining capacity
                if ($previousRemainingCapacity === null) {
                    $remainingCapacity = $totalCapacity - $checkInCount;
                    $previousRemainingCapacity = $remainingCapacity;
                } else {
                    $remainingCapacity = $previousRemainingCapacity - ($checkInCount - $checkOutCount);
                    $previousRemainingCapacity = $remainingCapacity;
                }

                // Store the data for this date
                $occupancyData[] = [
                    'date' => $checkDate,
                    'check_in' => $checkInCount,
                    'check_out' => $checkOutCount,
                    'remaining_capacity' => $remainingCapacity,
                ];

                // Move to the next date
                $startDate->addDay();
            }
        }


        return view('admin.reports.capacity', ['bookingDetails' => $occupancyData]);
    }
}

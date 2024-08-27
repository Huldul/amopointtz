<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class VisitController extends Controller
{
    public function trackVisit(Request $request)
    {
        try {
            $visitData = [
                'ip' => $request->ip,
                'city' => $request->city,
                'device' => $request->device,
                'visited_at' => Carbon::parse($request->timestamp)->format('Y-m-d H:i:s'),
            ];
            Visit::create($visitData);
            return response()->json(['message' => 'Visit tracked successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error in trackVisit: ' . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use Illuminate\Support\Facades\DB;
class StatisticsController extends Controller
{
    public function index()
    {
        $visitsPerHour = Visit::select(DB::raw('COUNT(DISTINCT ip) as visits'), DB::raw('HOUR(visited_at) as hour'))
                                ->groupBy('hour')
                                ->get();
        $visitsByCity = Visit::select(DB::raw('COUNT(id) as count'), 'city')
                                ->groupBy('city')
                                ->get();
        return view('statistics.index', compact('visitsPerHour', 'visitsByCity'));
    }
}

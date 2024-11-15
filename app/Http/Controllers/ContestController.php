<?php

namespace App\Http\Controllers;

use App\Services\ContestService;
use App\Models\Participation;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Competition;
use Illuminate\Support\Facades\Log;

class ContestController extends Controller
{
    protected ContestService $contestService;

    public function __construct(ContestService $contestService)
    {
        $this->contestService = $contestService;
    }

    public function show(int $year)
    {
        session(['contest_year' => $year]);
        $categories = $this->contestService->categoriesByYear($year);
        return view("contest", [
            "year" => $year,
            "categories" => $categories,
        ]);
    }

    public function showRegisteredRobots(int $year)
    {
        $registeredRobots = $this->contestService->registeredRobotsByYear($year);

        return view('contest.registered_robots', [
            'year' => $year,
            'registered_robots' => $registeredRobots,
        ]);
    }
}

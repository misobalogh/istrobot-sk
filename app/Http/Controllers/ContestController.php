<?php

namespace App\Http\Controllers;

use App\Services\ContestService;

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

    public function archive()
    {
        $thisYear = now()->year;
        return view('contest.archive', compact('thisYear'));
    }
}

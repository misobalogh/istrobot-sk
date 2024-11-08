<?php

namespace App\Http\Controllers;

use App\Services\ContestService;
use App\Models\Participation;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Competition;

class ContestController extends Controller
{
    protected ContestService $contestService;

    public function __construct(ContestService $contestService)
    {
        $this->contestService = $contestService;
    }

    public function show(int $year)
    {
        $registeredRobots = $this->contestService->registeredRobotsByYear($year);
        $categories = $this->contestService->categoriesByYear($year);
        return view("contest", [
            "year" => $year,
            "categories" => $categories,
            "registered_robots" => $registeredRobots,
        ]);
    }
}

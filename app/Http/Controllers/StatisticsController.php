<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ContestService; // Ensure ContestService is imported
use App\Models\Technology; // Import Technology model
use Illuminate\Support\Facades\Log;

class StatisticsController extends Controller
{
    protected $contestService;

    public function __construct(ContestService $contestService)
    {
        $this->contestService = $contestService;
    }

    public function index()
    {
        $currentYear = session('contest_year', Setting::where('key', 'competition_year')->first()->value);
        $robotsByCategory = $this->contestService->registeredRobotsByYear($currentYear);

        $categories = [];
        $totalRobots = 0;
        $robotIds = [];

        foreach ($robotsByCategory as $category => $robots) {
            $count = count($robots);
            $categories[] = ['name' => $category, 'count' => $count];
            $totalRobots += $count;

            foreach ($robots as $robot) {
                $robotIds[] = $robot['id'];
                $userIds[] = $robot['user_id'];
            }
        }

        $robotIds = array_unique($robotIds);
        $userIds = array_unique($userIds);

        $technologies = Technology::whereHas('robots', function ($query) use ($robotIds) {
            $query->whereIn('id', $robotIds);
        })->withCount('robots')->get();

        $countries = User::whereIn('id', $userIds)
            ->select('country_code')
            ->with('country')
            ->get()
            ->groupBy('country_code')
            ->map(function ($users) {
                return [
                    'name_SK' => $users->first()->country->name_SK ?? 'Unknown',
                    'name_EN' => $users->first()->country->name_EN ?? 'Unknown',
                    'count' => $users->count()
                ];
            })
            ->values();

        return view('statistics', compact('categories', 'totalRobots', 'technologies', 'countries'));
    }
}

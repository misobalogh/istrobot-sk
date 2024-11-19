<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ContestService; // Ensure ContestService is imported
use App\Models\Technology; // Import Technology model
use App\Models\Category; // Import Category model
use Illuminate\Support\Facades\App;
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

            $categoryModel = Category::where('name_EN', $category)
            ->orWhere('name_SK', $category)
            ->first();

            $localizedCategory = $categoryModel ? (App::getLocale() == 'en' ? $categoryModel->name_EN : $categoryModel->name_SK)  : $category;

            $categories[] = ['name' => $localizedCategory, 'count' => $count];
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

        // If technology name is Other, return it as Iné if the locale is SK
        $technologies = $technologies->map(function ($technology) {
            $technology->name = $technology->name == 'Other' && App::getLocale() == 'sk' ? 'Iné' : $technology->name;
            return $technology;
        });

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

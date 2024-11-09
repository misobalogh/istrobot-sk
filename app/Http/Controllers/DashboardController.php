<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Participation;
use App\Services\DashboardService;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $setYear = Setting::where('key', 'competition_year')->first()->value;
        
        $categories = $this->dashboardService->getAllCategories();
        $categoriesCount = $this->dashboardService->getCategoriesCount();
        $categoriesForSetYear = $this->dashboardService->getCategoriesByYear($setYear);
        $robots = $this->dashboardService->getUserRobots();
        $robotsParticipation = $this->dashboardService->getRobotsParticipation($setYear);

        return view('dashboard', [
            'setYear' => $setYear,
            'categories' => $categories,
            'categories_count' => $categoriesCount,
            'categoriesForSetYear' => $categoriesForSetYear,
            'robots' => $robots,
            'robotsParticipation' => $robotsParticipation
        ]);
    }

    public function updateRegistration(Request $request)
    {
        $selectedCategories = json_decode($request->input('selectedCategories'), true) ?? [];
        $setYear = Setting::where('key', 'competition_year')->first()->value;

        foreach ($selectedCategories as $item) {
            Participation::updateOrCreate(
                [
                    'robot_id' => $item['robot'],
                    'category_id' => $item['category'],
                    'competition_id' => Competition::where('year', $setYear)->first()->id,
                ],
            );
       }

        return redirect()->route('dashboard')->with('success','Registration updated successfully');
    }
}

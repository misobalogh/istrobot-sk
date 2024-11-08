<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $yearSet = 2024;
        
        $categories = $this->dashboardService->getAllCategories();
        $categoriesCount = $this->dashboardService->getCategoriesCount();
        $categoriesForSetYear = $this->dashboardService->getCategoriesByYear($yearSet);
        $robots = $this->dashboardService->getUserRobots();
        $robotsParticipation = $this->dashboardService->getRobotsParticipation($yearSet);

        return view('dashboard', [
            'categories' => $categories,
            'categories_count' => $categoriesCount,
            'categoriesForSetYear' => $categoriesForSetYear,
            'robots' => $robots,
            'robotsParticipation' => $robotsParticipation
        ]);
    }
}

<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Participation;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    public function getAllCategories()
    {
        return Category::all();
    }

    public function getCategoriesCount()
    {
        return Category::withCount('participations')->get();
    }

    public function getCategoriesByYear($year)
    {
        return Category::whereHas('competitions', function ($query) use ($year) {
            $query->where('year', $year);
        })->get();
    }

    public function getUserRobots()
    {
        return Auth::user()->robots;
    }

    public function getRobotsParticipation($year)
    {
        $userRobots = $this->getUserRobots();

        return Participation::whereIn('robot_id', $userRobots->pluck('id'))
            ->whereHas('competition', function ($query) use ($year) {
                $query->where('year', $year);
            })
            ->get()
            ->groupBy('robot_id')
            ->map(fn($items) => $items->pluck('category_id')->toArray());
    }
}
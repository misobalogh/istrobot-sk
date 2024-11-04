<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Competition;

class ContestController extends Controller
{
    public function show($year)
    {
        $registeredRobots = $this->registeredRobotsByYear($year);
        $categories = $this->categoriesByYear($year);
        return view("contest", [
            "year" => $year,
            "categories" => $categories,
            "registered_robots" => $registeredRobots,
        ]);
    }

    public function categoriesByYear($year)
    {
        $categories = Category::whereHas('competitions', function ($query) use ($year) {
            $query->where('year', $year);
        })->distinct('name_SK')->get(['name_SK as category_name']);

        return $categories;
    }

    public static function registeredRobotsByYear($year, $categoryId = null)
    {
        $query = Competition::where('year', $year)
            ->with(['participations.robot.user', 'categories']);

        if ($categoryId) {
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('id', $categoryId);
            });
        }

        $competitions = $query->get();

        $result = [];
        foreach ($competitions as $competition) {
            foreach ($competition->participations as $participation) {
                if ($categoryId && $participation->category_id != $categoryId) {
                    continue;
                }
                $result[] = [
                    'category_name' => $participation->category->name_SK,
                    'robots' => [$participation->robot->toArray()],
                ];
            }
        }

        return $result;
    }
}

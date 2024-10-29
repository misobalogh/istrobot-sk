<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use Illuminate\Http\Request;
use App\Models\Category;

class MainController extends Controller
{
    public function contest($year)
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

    public function registeredRobotsByYear($year)
    {
        $participations = Participation::with(['robot.user', 'category'])
            ->whereHas('competition', function ($query) use ($year) {
                $query->where('year', $year);
            })
            ->get();

        $registeredRobots = [];

        foreach ($participations as $participation) {
            $categoryName = $participation->category->name_SK;

            if (!isset($registeredRobots[$categoryName])) {
                $registeredRobots[$categoryName] = [];
            }

            $registeredRobots[$categoryName][] = [
                'robot_name' => $participation->robot->name,
                'robot_owner' => $participation->robot->user->first_name . ' ' . $participation->robot->user->last_name,
            ];
        }

        return $registeredRobots;
    }

}
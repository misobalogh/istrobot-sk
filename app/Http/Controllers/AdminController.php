<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\ContestController;

class AdminController extends Controller
{
    public function generateStartingList($year)
    {
        $registeredRobots = ContestController::registeredRobotsByYear($year);
        $startingList = [];
        $startingNumber = 1;

        foreach ($registeredRobots as $category) {
            $robots = $category['robots'];

            shuffle($robots);

            foreach ($robots as $index => $robot) {
                $startingList[] = [
                    'robot_name' => $robot['robot_name'],
                    'robot_owner' => $robot['robot_owner'],
                    'category_name' => $category['category_name'],
                    'starting_number' => $startingNumber++,
                ];
            }
        }

        return response()->json($startingList);
    }

    public function allEmails()
    {
        $emails = User::pluck('email')->toArray();
        return response()->json($emails);
    }

    public function emailsByYear($year)
    {
        $emails = User::whereHas('robots.participations.competition', function ($query) use ($year) {
            $query->where('year', $year);
        })->pluck('email')->toArray();

        return response()->json($emails);
    }
}
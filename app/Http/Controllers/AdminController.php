<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use Illuminate\Http\Request;
use App\Models\Category;
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
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\ContestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function generateStartingList(Request $request, $year)
    {
        $categoryId = $request->input('category');

        $registeredRobots = ContestController::registeredRobotsByYear($year, $categoryId);
        $startingList = [];
        $startingNumber = 1;

        foreach ($registeredRobots as $category) {
            $robots = $category['robots'];

            shuffle($robots);

            foreach ($robots as $index => $robot) {
                $startingList[] = [
                    'robot_name' => $robot['name'],
                    'robot_owner' => $robot['author_first_name']. ' ' . $robot['author_last_name'],
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

    public function showStartingList()
    {
        $categories = Category::all();
        return view('admin.starting-list', compact('categories'));
    }
}
<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Competition;

class ContestService
{
    public function categoriesByYear(int $year)
    {
        $categories = Category::whereHas('competitions', function ($query) use ($year) {
            $query->where('year', $year);
        })->distinct('name_SK')->get(['name_SK as category_name']);

        return $categories;
    }

    public function registeredRobotsByYear(int $year, ?int $categoryId = null): array
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
                if ($categoryId && $participation->category_id !== $categoryId) {
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
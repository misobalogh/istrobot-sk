<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;

class CategoryController extends Controller
{
    public function showCategoriesByYear($year)
    {
        $categories = Category::whereHas('competitions', function ($query) use ($year) {
            $query->where('year', $year);
        })->distinct('name_SK')->get(['name_SK as category_name']);

        Log::info('Year'. $year . 'Categories: ' . $categories);

        return view('index', [
            'categories' => $categories,
            'year' => $year,
        ]);
    }
}
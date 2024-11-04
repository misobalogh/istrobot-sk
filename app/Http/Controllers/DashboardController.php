<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    //
    public function categoriesWithCount() {
        $categories = Category::all();
        $categories_count = Category::withCount('participations')->get();
        return view('dashboard', compact('categories','categories_count'));
    }
}

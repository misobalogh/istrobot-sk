<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\ContestController;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Competition;
use App\Services\ContestService;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function generateStartingList(Request $request, $year)
    {
        $categoryId = $request->input('category');
        $contestService = new ContestService();
        $registeredRobots = $contestService->registeredRobotsByYear($year, $categoryId);

        $startingList = [];
        $startingNumber = 1;

        foreach ($registeredRobots as $categoryName => $robots) {
            shuffle($robots);

            foreach ($robots as $robot) {
                $startingList[] = [
                    'robot_name' => $robot['name'],
                    'robot_owner' => $robot['author'],
                    'category_name' => $categoryName,
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

    public function createCategory(CategoryUpdateRequest $request)
    {
        $category = new Category();
        $category->fill($request->validated());

        $admin = auth()->user()->admin;
        $category->admin_id = $admin->id;

        $category->save();

        return response()->json([
            'success' => true,
            'category' => [
                'id' => $category->id,
                'name_EN' => $category->name_EN,
                'name_SK' => $category->name_SK,
            ]
        ]);
    }

    public function deleteCategory($id) {
        $category = Category::find($id);
        if($category) {
            $category->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function setCategories(Request $request, $year)
    {
        $categories = $request->input('categories', []);
        
        $competition = Competition::firstOrCreate(['year' => $year], [
            'name' => "Istrobot $year",
            'admin_id' => auth()->id(),
        ]);
        
        $competition->categories()->sync($categories);

        return response()->json(['success' => true]);
    }

    public function getCategories(Request $request, $year)
    {
        $competition = Competition::where('year', $year)->first();

        if (!$competition) {
            return response()->json(['categories' => []]);
        }

        $categoryIds = $competition->categories()->pluck('id')->toArray();

        return response()->json(['categories' => $categoryIds]);
    }
    
    public function setYear(Request $request)
    {
        $year = $request->input('year');

        $setting = Setting::where('key', 'competition_year')->first();
        $setting->value = $year;
        $setting->save();

        return redirect()->route('dashboard')->with('status', 'year-set-successfuly');
    }

}

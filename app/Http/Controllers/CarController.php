<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('cars', compact('cars'));
    }

    public function display()
    {
        $cars = Car::all();
        return view('cars.carss', compact('cars'));
    }

    public function show($id)
    {
        $car = Car::find($id);
        return view('cars.show', compact('car'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $cars = Car::where('car_name', 'like', "%{$query}%")
            ->orWhere('location', 'like', "%{$query}%")
            ->get();

        return view('cars.carss', ['cars' => $cars]);
    }

    public function categoryCars($category)
    {
        $cars = Car::where('category', $category)->get();
        return view('cars.carss', ['cars' => $cars]);
    }

    public function review(Request $request)
    {
        $validatedData = $request->validate([
            'star' => 'required|integer|between:1,5',
        ]);

        $review = new CarReview();
        $review->client_id = auth()->id();
        $review->car_id = $request->car_id;
        $review->review_score = $validatedData['star'];
        $review->date_review = now();
        $review->save();

        return redirect()
            ->back()
            ->with('success', 'Review submitted successfully!');
    }
}

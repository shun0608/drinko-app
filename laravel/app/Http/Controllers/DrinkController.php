<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drink;

class DrinkController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $drinks = Drink::paginate(12)->withPath('/drinks');
    return $drinks;
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
  }

  /**
   * Display the specified resource.
   */
  public function show($id)
  {
    $drink = Drink::find($id);
    if (!$drink) {
      return response()->json(['message' => 'お探しのドリンクは存在しません'], 404);
    }
    $recommendedDrinks = Drink::where('id', '!=', $id)->inRandomOrder()->take(3)->get();

    return response()->json([
      'drink' => $drink,
      'recommended' => $recommendedDrinks
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}

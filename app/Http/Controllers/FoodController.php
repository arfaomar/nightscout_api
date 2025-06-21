<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodController extends Controller
{
    // GET /food
    public function index()
    {
        return response()->json([
            'message' => 'GET /food – Liste aller Food-Items (Demo)',
            'foods' => [
                ['id' => '1', 'name' => 'Banane', 'carbs' => 23],
                ['id' => '2', 'name' => 'Apfel', 'carbs' => 12]
            ]
        ]);
    }

    // GET /food/quickpicks
    public function quickpicks()
    {
        return response()->json([
            'message' => 'GET /food/quickpicks – QuickPicks (Demo)',
            'items' => [
                ['name' => 'Cola', 'carbs' => 10],
                ['name' => 'Traubenzucker', 'carbs' => 15]
            ]
        ]);
    }

    // GET /food/regular
    public function regular()
    {
        return response()->json([
            'message' => 'GET /food/regular – Standard-Food-Items (Demo)',
            'items' => [
                ['name' => 'Müsli', 'carbs' => 40],
                ['name' => 'Toast', 'carbs' => 25]
            ]
        ]);
    }

    // POST /food
    public function store(Request $request)
    {
        return response()->json([
            'message' => 'POST /food – neues Item empfangen (Demo)',
            'received' => $request->all()
        ]);
    }

    // PUT /food
    public function update(Request $request)
    {
        return response()->json([
            'message' => 'PUT /food – Item aktualisiert (Demo)',
            'received' => $request->all()
        ]);
    }

    // DELETE /food/{id}
    public function destroy($id)
    {
        return response()->json([
            'message' => "DELETE /food/$id – gelöscht (Demo)"
        ]);
    }
}

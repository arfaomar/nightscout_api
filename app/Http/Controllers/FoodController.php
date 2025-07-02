<?php

namespace App\Http\Controllers;

use App\Helpers\QueryHelper;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FoodController extends Controller
{
    // GET /food
    public function index(Request $request)
    {
        $query = Food::query();

        // Optional: Nightscout-kompatible Suche
        $find = $request->query('find', []);
        QueryHelper::applyNightscoutFind($query, $find);

        // Optional: Limit (z.B. count=10)
        $count = $request->query('count');
        QueryHelper::applyCount($query, $count);

        $foods = $query->get();

        return response()->json($foods);
    }

    // GET /food/quickpicks
    public function quickpicks(Request $request)
    {
        $foods = Food::where('extra_data->category', 'quickpick')->get();

        return response()->json($foods);
    }

    // GET /food/regular
    public function regular(Request $request)
    {
        $foods = Food::where('extra_data->category', 'regular')->get();

        return response()->json($foods);
    }

    // POST /food
    public function store(Request $request)
    {
        $data = $request->all();

        if (! isset($data['_id'])) {
            $data['_id'] = Str::random(24);
        }

        if (isset($data['created_at'])) {
            $data['created_at'] = \Carbon\Carbon::parse($data['created_at'])->format('Y-m-d H:i:s');
        } else {
            $data['created_at'] = now()->format('Y-m-d H:i:s');
        }

        $fixedFields = ['_id', 'created_at'];
        $extra = collect($data)->except($fixedFields)->toArray();
        $main = collect($data)->only($fixedFields)->toArray();
        $main['extra_data'] = $extra;

        $food = Food::create($main);

        return response()->json($food, 201);
    }

    // PUT /food
    public function update(Request $request)
    {
        $data = $request->all();

        if (! isset($data['_id'])) {
            return response()->json(['message' => 'Missing _id'], 400);
        }

        $food = Food::find($data['_id']);
        if (! $food) {
            return response()->json(['message' => 'Food not found'], 404);
        }

        $fixedFields = ['_id', 'created_at'];
        $extra = collect($data)->except($fixedFields)->toArray();
        $main = collect($data)->only($fixedFields)->toArray();
        $main['extra_data'] = $extra;

        $food->update($main);

        return response()->json($food);
    }

    // DELETE /food/{id}
    public function destroy($id)
    {
        $food = Food::find($id);
        if (! $food) {
            return response()->json(['message' => 'Food not found'], 404);
        }
        $food->delete();

        return response()->json(['message' => 'Food deleted', 'id' => $id]);
    }
}

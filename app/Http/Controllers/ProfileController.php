<?php

namespace App\Http\Controllers;

use App\Helpers\QueryHelper;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // GET /profiles
    public function index(Request $request)
    {
        $query = Profile::query();
        $find = $request->query('find', []);
        QueryHelper::applyNightscoutFind($query, $find);

        $count = $request->query('count');
        QueryHelper::applyCount($query, $count);

        $profiles = $query->get();

        return response()->json($profiles);
    }

    // GET /profile
    public function show(Request $request)
    {
        $profile = Profile::orderByDesc('date')->first();
        if (! $profile) {
            return response()->json(['message' => 'No profile found'], 404);
        }

        return response()->json($profile);
    }

    // GET /profile/current
    public function current()
    {
        $profile = Profile::orderByDesc('date')->first();
        if (! $profile) {
            return response()->json(['message' => 'No current profile found'], 404);
        }

        return response()->json($profile);
    }

    // POST /profile
    public function store(Request $request)
    {
        $data = $request->all();
        if (is_array($data) && isset($data[0])) {
            $data = $data[0];
        }
        if (! isset($data['_id'])) {
            $data['_id'] = bin2hex(random_bytes(12));
        }

        if (isset($data['created_at'])) {
            $data['created_at'] = \Carbon\Carbon::parse($data['created_at']);
        }
        if (isset($data['startDate'])) {
            $data['startDate'] = \Carbon\Carbon::parse($data['startDate']);
        }
        $fixedFields = [
            '_id', 'defaultProfile', 'date', 'created_at', 'startDate', 'store',
        ];
        $extra = collect($data)->except($fixedFields)->toArray();
        $main = collect($data)->only($fixedFields)->toArray();
        $main['extra_data'] = $extra;

        $profile = Profile::create($main);

        return response()->json([
            'message' => 'Profile saved',
            'id' => $profile->_id,
        ], 201);
    }

    // PUT /profile
    public function update(Request $request)
    {
        $data = $request->all();
        $id = $data['_id'] ?? null;
        if (! $id) {
            return response()->json(['message' => 'Profile _id required'], 400);
        }
        $profile = Profile::find($id);
        if (! $profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }
        $profile->update($data);

        return response()->json(['message' => 'Profile updated']);
    }

    // DELETE /profile/{_id}
    public function destroy($id)
    {
        $profile = Profile::find($id);
        if (! $profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }
        $profile->delete();

        return response()->json(['message' => 'Profile deleted', 'id' => $id]);
    }
}

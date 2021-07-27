<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    public function index()
    {
        return Interest::all();
    }
    public function show(Interest $interest)
    {
        return $interest;
    }

    public function update(Request $request, Interest $interest)
    {
        $validatedData = $request->validate([
            'text' => 'required|string',
        ]);

        $interest->update($request->all());
        return response()->json($interest, 200);
    }
    public function delete(Interest $interest)
    {
        $interest->delete();
        return response()->json(null, 204);
    }
}

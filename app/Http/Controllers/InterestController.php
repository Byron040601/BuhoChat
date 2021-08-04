<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
//    public function index()
//    {
//        return Interest::all();
//    }
    public function show(Interest $interest)
    {
        //$this->authorize('view', $interest);
        return $interest;
    }

    public function update(Request $request, Interest $interest)
    {
        $this->authorize('update', $interest);
        $validatedData = $request->validate([
            'text' => 'required|string',
        ]);

        $interest->update($request->all());
        return response()->json($interest, 200);
    }
    public function delete(Interest $interest)
    {
        $this->authorize('delete', $interest);
        $interest->delete();
        return response()->json(null, 204);
    }
}

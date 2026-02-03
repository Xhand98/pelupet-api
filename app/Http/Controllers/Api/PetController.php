<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        return Pet::with('customer')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'name' => 'required|string',
            'species' => 'required|string',
            'breed' => 'nullable|string',
            'age' => 'nullable|integer',
            'weight' => 'nullable|numeric',
            'medical_notes' => 'nullable|string',
        ]);

        return Pet::create($request->all());
    }

    public function show(string $id)
    {
        return Pet::with('customer', 'appointments')->findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $pet = Pet::findOrFail($id);
        $pet->update($request->all());
        return $pet;
    }

    public function destroy(string $id)
    {
        Pet::destroy($id);
        return response()->json(['message' => 'Pet deleted']);
    }
}

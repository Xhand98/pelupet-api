<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return Service::where('is_active', true)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|in:veterinary,grooming,other',
            'price' => 'required|numeric',
            'duration' => 'nullable|integer',
        ]);

        return Service::create($request->all());
    }

    public function show(string $id)
    {
        return Service::findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->all());
        return $service;
    }

    public function destroy(string $id)
    {
        Service::destroy($id);
        return response()->json(['message' => 'Service deleted']);
    }
}

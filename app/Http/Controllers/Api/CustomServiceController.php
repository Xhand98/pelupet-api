<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CustomService;
use Illuminate\Http\Request;

class CustomServiceController extends Controller
{
    public function index()
    {
        return CustomService::with('customer')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_name' => 'required|string',
            'description' => 'required|string',
            'estimated_price' => 'nullable|numeric',
        ]);

        return CustomService::create($request->all());
    }

    public function show(string $id)
    {
        return CustomService::with('customer')->findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $customService = CustomService::findOrFail($id);
        $customService->update($request->all());
        return $customService;
    }

    public function destroy(string $id)
    {
        CustomService::destroy($id);
        return response()->json(['message' => 'Custom service deleted']);
    }

    public function approve($id)
    {
        $customService = CustomService::findOrFail($id);
        $customService->update(['status' => 'approved']);
        return $customService;
    }

    public function reject(Request $request, $id)
    {
        $customService = CustomService::findOrFail($id);
        $customService->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes
        ]);
        return $customService;
    }
}

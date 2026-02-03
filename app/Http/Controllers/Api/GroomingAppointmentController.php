<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GroomingAppointment;
use Illuminate\Http\Request;

class GroomingAppointmentController extends Controller
{
    public function index()
    {
        return GroomingAppointment::with('customer', 'pet', 'service')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'pet_id' => 'required|exists:pets,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date',
            'status' => 'nullable|in:pending,confirmed,in_progress,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        return GroomingAppointment::create($request->all());
    }

    public function show(string $id)
    {
        return GroomingAppointment::with('customer', 'pet', 'service')->findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $appointment = GroomingAppointment::findOrFail($id);
        $appointment->update($request->all());
        return $appointment;
    }

    public function destroy(string $id)
    {
        GroomingAppointment::destroy($id);
        return response()->json(['message' => 'Appointment deleted']);
    }
}

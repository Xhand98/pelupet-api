<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::with('user', 'pets')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'nullable|string',
        ]);

        return Customer::create($request->all());
    }

    public function show(string $id)
    {
        return Customer::with('user', 'pets', 'appointments')->findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return $customer;
    }

    public function destroy(string $id)
    {
        Customer::destroy($id);
        return response()->json(['message' => 'Customer deleted']);
    }
}

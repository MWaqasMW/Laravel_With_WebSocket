<?php

namespace App\Http\Controllers;

use App\Models\Customer; // Corrected model name
use Illuminate\Http\Request;
use App\Events\NewCustomerEvent;
use App\Events\DeletCustomer;

class CustomerController extends Controller // Updated class name
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string',
            'email' => 'required|email|unique:customers',
            'number' => 'required|string',
        ]);

        $newCustomer = Customer::create($validatedData);

        broadcast(new NewCustomerEvent($newCustomer))->toOthers();
        return response()->json($newCustomer, 201);
    }
    public function getCustomers()
    {
        $customers = Customer::all();

        return response()->json($customers, 200);
    }
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        broadcast(new DeletCustomer($customer->id))->toOthers();

        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully'], 200);
    }
}

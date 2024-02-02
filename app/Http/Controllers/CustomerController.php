<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Events\NewCustomerEvent;
use App\Events\DeletCustomer;
use App\Events\UpdateCustomerEvent; // Added UpdateCustomerEvent

class CustomerController extends Controller
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

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validatedData = $request->validate([
            'username' => 'required|string',
            'email' => 'required|email|unique:customers,email,' . $id,
            'number' => 'required|string',
        ]);

        $customer->update($validatedData);

        broadcast(new UpdateCustomerEvent($customer))->toOthers();

        return response()->json($customer, 200);
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        broadcast(new DeletCustomer($customer->id))->toOthers();

        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully'], 200);
    }
}

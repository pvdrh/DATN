<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $agency_id = auth()->user()->agency_id;
        if (empty($agency_id)) {
            $customers = Customer::with('agency')->paginate(10);
            $agencies = Agency::all();
        } else {
            $agencies = Agency::where('id', $agency_id)->get();
            $customers = Customer::with('agency')->where('agency_id', $agency_id)->paginate(10);
        }

        return view('customers.index', compact('customers', 'agencies'));
    }

    public function create()
    {
        $agency_id = auth()->user()->agency_id;
        if (empty($agency_id)) {
            $agencies = Agency::all();
        } else {
            $agencies = Agency::where('id', $agency_id)->get();
        }

        return view('customers.create', compact('agencies'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'agency_id' => 'required|exists:agencies,id',
            'gender' => 'nullable|in:0,1',
            'medical_information' => 'nullable|string',
            'dob' => 'nullable|date'
        ]);

        Customer::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'] ?? '',
            'address' => $validatedData['address'] ?? '',
            'email' => $validatedData['email'] ?? '',
            'agency_id' => $validatedData['agency_id'],
            'gender' => $validatedData['gender'],
            'dob' => $validatedData['dob'] ?? '',
            'medical_information' => json_encode($validatedData['medical_information'])
        ]);

        return redirect()->route('customers.index');
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        $agencies = Agency::all();

        return view('customers.edit', compact('customer', 'agencies'));
    }
}

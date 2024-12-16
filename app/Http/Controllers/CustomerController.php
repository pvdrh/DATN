<?php

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Models\Agency;
use App\Models\Customer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $agency_id = auth()->user()->agency_id;
        $search = $request->input('search');

        $customers = Customer::with('agency');

        if (!empty($agency_id)) {
            $customers = $customers->where('agency_id', $agency_id);
            $agencies = Agency::where('id', $agency_id)->get();
        } else {
            $agencies = Agency::all();
        }

        if ($search) {
            $customers = $customers->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('phone', 'LIKE', "%$search%");
            });
        }

        $customers = $customers->paginate(10)->appends(['search' => $search]);

        return view('customers.index', compact('customers', 'agencies', 'search'));
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

    public function export()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }
}

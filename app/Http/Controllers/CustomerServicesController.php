<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerService;
use App\Models\Service;
use Illuminate\Http\Request;

class CustomerServicesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $items = CustomerService::with(['customer', 'service', 'user'])
            ->whereHas('customer', function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                }
            })
            ->orWhereHas('service', function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                }
            })
            ->paginate(10);

        return view('customers.services.index', compact('items', 'search'));
    }

    public function create()
    {
        $services = Service::where('status', 1)->get();
        $customers = Customer::all();

        return view('customers.services.create', compact('services', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
        ]);

        CustomerService::create([
            'customer_id' => $request->customer_id,
            'service_id' => $request->service_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('customer_services.index');
    }

    public function edit($id)
    {
        $item = CustomerService::findOrFail($id);
        $services = Service::where('status', 1)->get();
        $customers = Customer::all();

        return view('customers.services.edit', compact('item', 'services', 'customers'));
    }
}

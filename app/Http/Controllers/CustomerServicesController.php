<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerService;
use App\Models\Service;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerServicesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $items = CustomerService::with([
            'customer' => function ($query) {
                $query->withTrashed();
            },
            'service' => function ($query) {
                $query->withTrashed();
            },
            'user' => function ($query) {
                $query->withTrashed();
            }
        ])
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
            ->orderBy('created_at', 'desc');
        if (!auth()->user()->is_protected) {
            $items = $items->where('agency_id', auth()->user()->agency_id);
        }
        $items = $items->paginate(10);

        return view('customers.services.index', compact('items', 'search'));
    }

    public function create()
    {
        $agency_id = auth()->user()->agency_id;
        if (empty($agency_id)) {
            $services = Service::where('status', 1)->get();
            $customers = Customer::all();
        } else {
            $services = Service::where(['status' => 1, 'agency_id' => $agency_id])->get();
            $customers = Customer::where('agency_id', $agency_id)->get();
        }

        return view('customers.services.create', compact('services', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'end_time' => 'required',
        ]);
        $amount = $request->amount;
        $amount = (int)str_replace('.', '', $amount);
        CustomerService::create([
            'customer_id' => $request->customer_id,
            'service_id' => $request->service_id,
            'user_id' => auth()->id(),
            'end_time' => $request->end_time,
            'agency_id' => auth()->user()->agency_id,
        ]);

        Transaction::create([
            'customer_id' => $request->customer_id,
            'service_id' => $request->service_id,
            'user_id' => auth()->id(),
            'agency_id' => auth()->user()->agency_id,
            'amount' => $amount,
            'created_at' => now(),
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

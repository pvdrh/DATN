<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerSchedule;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerSchedulesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $items = CustomerSchedule::with(['customer', 'user'])
            ->whereHas('customer', function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                }
            })
            ->paginate(10);

        return view('customers.schedules.index', compact('items'));
    }

    public function create()
    {
        $customers = Customer::all();
        $users = User::where('role', 3)->get();
        return view('customers.schedules.create', compact('customers', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
        ]);

        CustomerSchedule::create([
            'customer_id' => $request->customer_id,
            'user_id' => $request->user_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'agency_id' => auth()->user()->agency_id,
        ]);

        return redirect()->route('customer_schedules.index');
    }

    public function destroy($id)
    {
        $customer_schedule = CustomerSchedule::findOrFail($id);

        $customer_schedule->delete();

        return redirect()->route('customer_schedules.index');
    }
}

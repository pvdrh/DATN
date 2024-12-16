<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['phone' => $attributes['phone'], 'password' => $attributes['password']])) {
            session()->regenerate();
            return redirect('dashboard');
        } else {
            return back();
        }
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/login');
    }

    public function profile()
    {
        return view('profile');
    }

    public function transaction(Request $request)
    {
        $agencyId = $request->input('agency_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Base query with relationships
        $transactions = Transaction::with(['customer', 'service', 'user', 'agency']);

        // Filter by agency
        if ($agencyId) {
            $transactions->where('agency_id', $agencyId);
        }

        // Filter by date range
        if ($startDate) {
            $transactions->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $transactions->whereDate('created_at', '<=', $endDate);
        }

        // Paginate results
        $transactions = $transactions->paginate(10);

        // Fetch all agencies for dropdown
        $agencies = Agency::all();

        return view('transaction', compact('transactions', 'agencies'));
    }
}

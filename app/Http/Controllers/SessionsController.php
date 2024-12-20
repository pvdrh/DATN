<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;

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
        $agencyId = auth()->user()->is_protected ? $request->input('agency_id') : auth()->user()->agency_id;
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $transactions = Transaction::with([
            'customer' => fn($query) => $query->withTrashed(),
            'service' => fn($query) => $query->withTrashed(),
            'user' => fn($query) => $query->withTrashed(),
            'agency' => fn($query) => $query->withTrashed(),
        ]);
        if ($agencyId) {
            $transactions->where('agency_id', $agencyId);
        }

        if ($startDate) {
            $transactions->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $transactions->whereDate('created_at', '<=', $endDate);
        }

        $transactions = $transactions->paginate(10);

        $agencies = Agency::all();

        return view('transaction', compact('transactions', 'agencies'));
    }

    public function changePassword(Request $request)
    {
        // Validate dữ liệu nhập vào
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            'new_password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Mật khẩu hiện tại không đúng.',
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Mật khẩu đã được thay đổi thành công.',
        ]);
    }

    public function changePasswordForUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'new_password.required' => 'Mật khẩu mới không được để trống.',
            'new_password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Mật khẩu đã được cập nhật thành công.',
        ]);
    }


    public function transaction_export(Request $request)
    {
        // Lấy bộ lọc từ request
        $filters = [
            'agency_id' => $request->input('agency_id'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ];

        // Xuất file Excel với bộ lọc hiện tại
        return Excel::download(new TransactionsExport($filters), 'transactions.xlsx');
    }
}

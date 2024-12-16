<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

use function Termwind\renderUsing;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::query();
        $users = $users->with('agency')
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('phone', 'LIKE', "%$search%");
            });
        if (Auth::user()->role != 1) {
            $users = $users->where('agency_id', Auth::user()->agency_id);
        }

        $users = $users->paginate(10);

        return view('users.index', compact('users', 'search'));
    }


    public function create()
    {
        $agencies = Agency::all();

        return view('users.create')->with(['agencies' => $agencies]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|integer|in:1,2,3',
            'agency_id' => 'required|exists:agencies,id',
            'address' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
        ]);

        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => bcrypt(123456),
            'role' => $request->role,
            'agency_id' => $request->agency_id,
            'address' => $request->address ?? '',
            'dob' => $request->dob ?? '',
            'gender' => $request->gender
        ]);

        return redirect()->route('users.index');
    }


    public function edit($id)
    {
        $user = User::find($id);
        $agencies = Agency::all();

        return view('users.edit')->with(['user' => $user, 'agencies' => $agencies]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $data = $request->except(['phone']);

        $user->update($data);

        return redirect()->route('users.index');
    }

    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);

        if (!$user->is_protected) {
            $user->delete();
        }

        return redirect()->route('users.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $agencies = Agency::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%");
            })
            ->paginate(10);

        return view('agencies.index', compact('agencies'));
    }

    public function create()
    {
        return view('agencies.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        // Lưu dữ liệu vào cơ sở dữ liệu
        $agency = new Agency();
        $agency->name = $validated['name'];
        $agency->phone = $validated['phone'] ?? null;
        $agency->address = $validated['address'] ?? null;
        $agency->email = $validated['email'] ?? null;
        $agency->save();

        return redirect()->route('agencies.index');
    }

    public function edit($id)
    {
        $agency = Agency::find($id);
        return view('agencies.edit')->with('agency', $agency);
    }

    public function update(Request $request, $id)
    {
        $agency = Agency::find($id);

        $data = $request->all();
        $agency->update($data);

        return redirect()->route('agencies.index');
    }

    public function destroy($agency_id)
    {
        $agency = Agency::findOrFail($agency_id);

        $agency->delete();

        return redirect()->route('agencies.index');
    }
}

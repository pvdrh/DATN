<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $services = Service
            ::when($search, function ($query, $search) {
                $query->where('name', 'LIKE', "%$search%");
            })->with('agency');
        if (Auth::user()->role != 1) {
            $services = $services->where('agency_id', Auth::user()->agency_id);
        }

        $services = $services->paginate(10);

        return view('services.index', compact('services', 'search'));
    }


    public function create()
    {
        $agency_id = auth()->user()->agency_id;
        if (empty($agency_id)) {
            $services = Service::all();
            $agencies = Agency::all();
        } else {
            $services = Service::where('agency_id', $agency_id)->get();
            $agencies = Agency::where('id', $agency_id)->get();
        }

        return view('services.create')->with(['services' => $services, 'agencies' => $agencies]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'agency_id' => 'required|exists:agencies,id',
            'description' => 'nullable|string',
        ]);

        Service::create([
            'name' => $request->name,
            'agency_id' => $request->agency_id,
            'description' => $request->description,
            'status' => $request->status,
            'price' => $request->price,
            'duration' => $request->duration,
            'type' => $request->type,
        ]);

        return redirect()->route('services.index');
    }


    public function edit($id)
    {
        $service = Service::with('agency')->find($id);
        $agencies = Agency::all();

        return view('services.edit')->with(['service' => $service, 'agencies' => $agencies]);
    }

    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        $service->update($request->all());

        return redirect()->route('services.index')->with('success', 'Cập nhật thông tin người dùng thành công.');
    }

    public function destroy($service_id)
    {
        $service = Service::findOrFail($service_id);
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Xóa dịch vụ thành công.');
    }
}

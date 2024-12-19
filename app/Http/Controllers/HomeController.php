<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Customer;
use App\Models\CustomerSchedule;
use App\Models\Page;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }

    public function dashboard()
    {
        $agencyId = auth()->user()->agency_id;

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $previousMonth = Carbon::now()->subMonth()->month;
        $previousYear = Carbon::now()->subMonth()->year;

        $currentMonthRevenueQuery = Transaction::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth);
        if ($agencyId !== null) {
            $currentMonthRevenueQuery->where('agency_id', $agencyId);
        }
        $currentMonthRevenue = $currentMonthRevenueQuery->sum('amount');

        $previousMonthRevenueQuery = Transaction::whereYear('created_at', $previousYear)
            ->whereMonth('created_at', $previousMonth);
        if ($agencyId !== null) {
            $previousMonthRevenueQuery->where('agency_id', $agencyId);
        }
        $previousMonthRevenue = $previousMonthRevenueQuery->sum('amount');

        $revenueChangePercentage = $previousMonthRevenue > 0
            ? (($currentMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100
            : ($currentMonthRevenue > 0 ? 100 : 0);

        $currentMonthCustomersQuery = Customer::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth);
        if ($agencyId !== null) {
            $currentMonthCustomersQuery->where('agency_id', $agencyId);
        }
        $currentMonthCustomers = $currentMonthCustomersQuery->count();

        $previousMonthCustomersQuery = Customer::whereYear('created_at', $previousYear)
            ->whereMonth('created_at', $previousMonth);
        if ($agencyId !== null) {
            $previousMonthCustomersQuery->where('agency_id', $agencyId);
        }
        $previousMonthCustomers = $previousMonthCustomersQuery->count();

        $customerChangePercentage = $previousMonthCustomers > 0
            ? (($currentMonthCustomers - $previousMonthCustomers) / $previousMonthCustomers) * 100
            : ($currentMonthCustomers > 0 ? 100 : 0);

        $currentMonthEmployeesQuery = User::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth);
        if ($agencyId !== null) {
            $currentMonthEmployeesQuery->where('agency_id', $agencyId);
        }
        $currentMonthEmployees = $currentMonthEmployeesQuery->count();

        $previousMonthEmployeesQuery = User::whereYear('created_at', $previousYear)
            ->whereMonth('created_at', $previousMonth);
        if ($agencyId !== null) {
            $previousMonthEmployeesQuery->where('agency_id', $agencyId);
        }
        $previousMonthEmployees = $previousMonthEmployeesQuery->count();

        $employeeChangePercentage = $previousMonthEmployees > 0
            ? (($currentMonthEmployees - $previousMonthEmployees) / $previousMonthEmployees) * 100
            : ($currentMonthEmployees > 0 ? 100 : 0);
        $next7Days = CustomerSchedule::whereBetween('start_time', [Carbon::now(), Carbon::now()->addDays(7)]);
        if ($agencyId !== null) {
            $next7Days->where('agency_id', $agencyId);
        }
        $schedules = $next7Days->with('customer', 'user')->get();

        $agencies = DB::table('agencies')
            ->select('agencies.*')
            ->addSelect([
                'customers_count' => DB::table('customers')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('agency_id', 'agencies.id'),
                'users_count' => DB::table('users')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('agency_id', 'agencies.id'),
                'sessions_count' => DB::table('customer_services')
                    ->join('customers', 'customer_services.customer_id', '=', 'customers.id')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('customers.agency_id', 'agencies.id')
            ])
            ->get();

        $agencyStatistics = $agencies->map(function ($agency) {
            $currentMonthRevenue = Transaction::where('agency_id', $agency->id)
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month)
                ->sum('amount');

            $mostPopularService = Service::select('services.id', 'services.name')
                ->join('customer_services', 'customer_services.service_id', '=', 'services.id')
                ->where('services.agency_id', $agency->id)
                ->groupBy('services.id', 'services.name')
                ->orderByRaw('COUNT(customer_services.id) DESC')
                ->limit(1)
                ->first();

            return [
                'agency' => $agency->name,
                'revenue' => $currentMonthRevenue,
                'total_customers' => $agency->customers_count,
                'total_employees' => $agency->users_count,
                'total_sessions' => $agency->sessions_count,
                'most_popular_service' => $mostPopularService ? $mostPopularService->name : '-',
            ];
        });

        $sortedAgencies = $agencyStatistics->sortByDesc('revenue');

        return view('dashboard', [
            'totalRevenue' => $currentMonthRevenue,
            'revenueChangePercentage' => $revenueChangePercentage,
            'totalCustomers' => $currentMonthCustomers,
            'customerChangePercentage' => $customerChangePercentage,
            'totalEmployees' => $currentMonthEmployees,
            'employeeChangePercentage' => $employeeChangePercentage,
            'schedules' => $schedules,
            'agencies' => $sortedAgencies,
        ]);
    }

    public function getPageBySlug($slug)
    {
        $page = Page::where('slug', $slug)->where('status', 1)->first();

        return view('page', compact('page'));
    }
}

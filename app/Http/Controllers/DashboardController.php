<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Orders;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalProducts = Products::count();
    $totalOrders = Orders::count();
    $totalSales = Orders::sum('order_amount');
    $todayOrders = Orders::whereDate('order_date', now())->count();

    $weeklyOrders = Orders::selectRaw('DAYNAME(order_date) as day, COUNT(*) as total')
                            ->whereBetween('order_date', [now()->startOfWeek(), now()->endOfWeek()])
                            ->groupBy('day')
                            ->get();

    $incomeExpense = [
        'labels' => ['January', 'February', 'March', 'April'], // contoh
        'income' => [1000000, 1500000, 1250000, 2000000],
        'expenses' => [500000, 700000, 600000, 800000],
    ];

    // Tambahkan ini: ambil 5 produk terlaris
    $bestSellingProducts = OrderDetails::selectRaw('product_id, SUM(qty) as total_qty')
        ->groupBy('product_id')
        ->orderByDesc('total_qty')
        ->with('product') // relasi ke model product
        ->take(5)
        ->get();

    return view('dashboard.index', compact(
        'totalProducts',
        'totalOrders',
        'totalSales',
        'todayOrders',
        'weeklyOrders',
        'incomeExpense',
        'bestSellingProducts' // kirim ke view
    ));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCustomers = Customer::count();
        $totalSuppliers = Supplier::count();

        $data = [
            'total_products' => $totalProducts,
            'total_orders' => $totalOrders,
            'total_customers' => $totalCustomers,
            'total_suppliers' => $totalSuppliers,
        ];

        return response()->json($data);
    }
}

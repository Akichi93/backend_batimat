<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    protected $order;

    public function __construct(OrderRepository $order)
    {
        $this->order = $order;
    }

    /*
      |----------------------------------------------------
      | Order list
      |----------------------------------------------------
      |
      | This function displays
      | a list of all orders .
      |
     */

    public function getOrder()
    {
        try {
            $orders = $this->order->getAllOrders();
            return response()->json($orders);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving orders.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /*
      |----------------------------------------------------
      | Adding orders
      |----------------------------------------------------
      |
      | This function lets you add orders
      |
     */

    public function postOrder(OrderStoreRequest $request)
    {

        // Form validation
        $validated = $request->validated();

        // Get data
        $data = $request->all();

        // Insert in database
        $Data = $this->order->postOrder($data);

        if ($Data) {
            return response()->json($Data);
        }
    }

    public function editOrder($uuidOrder){
        $products = $this->order->editOrder($uuidOrder);
        return response()->json($products);
    }
}

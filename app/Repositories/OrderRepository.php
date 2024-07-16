<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Log;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class OrderRepository.
 */
class OrderRepository extends BaseRepository
{
    protected $orders;

    public function __construct(Order $orders)
    {
        $this->orders = $orders;
    }
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public function getAllOrders()
    {
        return Order::with(['orderDetails.product', 'customer'])->get();
    }

    public function postOrder(array $data)
    {
        $id = Customer::where('uuidCustomer', $data['customer_id'])->value('id');

        try {
            $orders = new Order();
            $orders->uuidOrder = $data['uuidOrder'];
            $orders->payment_method = $data['payment_method'];
            $orders->customer_id = $id;
            $orders->save();

            foreach ($data['products'] as $productInfo) {

                $product = Product::where('uuidProduct', $productInfo['productId'])->first();

                if ($product) {

                    OrderDetail::create([
                        'order_id' => $orders->id,
                        'product_id' => $product->id,
                        'uuidOrder' => $orders->uuidOrder,
                        'quantity' => $productInfo['quantity'],
                        'unit_price' => $productInfo['unit_price'],
                        'total_price' => $productInfo['amount'],
                    ]);
                }
            }




            return response()->json($orders);
        } catch (\Exception $e) {

            return response()->json(['message' => 'An error occurred while creating the order.'], 500);
        }
    }

    public function editOrder($uuidOrder)
    {
        $order = Order::with(['orderDetails.product', 'customer'])->where('uuidOrder', $uuidOrder)->first();

        return $order;
    }
}

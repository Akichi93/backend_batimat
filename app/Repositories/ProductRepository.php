<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Stock;
use App\Models\Supplier;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ProductRepository.
 */
class ProductRepository extends BaseRepository
{
    protected $products;

    public function __construct(Product $products)
    {
        $this->products = $products;
    }
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public function getAllProducts()
    {
        return Product::with('supplier')->get();
    }

    public function postProduct(array $data)
    {

        // Check if product already exists
        if (Product::where([
            ['uuidSupplier', $data['supplier_id']],
            ['product_name', $data['product_name']],
        ])->exists()) {
            return response()->json(['message' => 'Produit existant'], 422);
        }

        //get Supplier ID
        $id = Supplier::where('uuidSupplier', $data['supplier_id'])->value('id');

        try {
            $products = new Product();
            $products->uuidProduct = $data['uuidProduct'];
            $products->product_name = $data['product_name'];
            $products->uuidSupplier = $data['supplier_id'];
            $products->supplier_id = $id;
            $products->supplier_reference = $data['supplier_reference'];
            $products->barcode = $data['barcode'];
            $products->internal_reference = $data['internal_reference'];
            $products->designation = $data['designation'];
            $products->quantity = $data['quantity'];
            $products->amount = $data['amount'];
            $products->save();

            return response()->json($products);
        } catch (\Exception $e) {

            return response()->json(['message' => 'An error occurred while creating the product.'], 500);
        }
    }

    public function editProduct($uuidProduct)
    {
        $customer = Product::where('uuidProduct', $uuidProduct)->first();
        return $customer;
    }

    public function updateProduct($uuidProduct, array $data)
    {

        $product = Product::where('uuidProduct', $uuidProduct)->first();

        if ($product) {
            $product->update($data);
            return $product;
        }
    }

    public function updateQuantity($uuidProduct, array $data)
    {
        $product = Product::where('uuidProduct', $uuidProduct)->first();

        if ($product) {
            $product->update($data);
            return $product;
        }
    }

    public function getProductPrice($uuidProduct)
    {
        $product = Product::select('amount','quantity')->where('uuidProduct', $uuidProduct)->first();
        return $product;
    }

    public function getProductQuantity($uuidProduct)
    {
        $product = Product::where('uuidProduct', $uuidProduct)->value('quantity');
        return $product;
    }
}

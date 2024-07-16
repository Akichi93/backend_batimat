<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\ProductRepository;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends Controller
{
    protected $product;

    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    /**
     * Get all products.
     *
     * Retrieves a list of all products.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProduct()
    {
        try {
            $products = $this->product->getAllProducts();
            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving products.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a new product.
     *
     * Stores a new product based on the incoming request.
     *
     * @param  \App\Http\Requests\ProductStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postProduct(ProductStoreRequest $request)
    {
        // Log the incoming request data
        Log::info($request->all());

        // Validate the incoming request
        $validated = $request->validated();

        // Get data from the validated request
        $data = $request->all();

        // Insert product into the database
        $product = $this->product->postProduct($data);

        if ($product) {
            return response()->json($product);
        }
    }

    /**
     * Edit a product.
     *
     * Retrieves a specific product for editing.
     *
     * @param  string  $uuidProduct
     * @return \Illuminate\Http\JsonResponse
     */
    public function editProduct($uuidProduct)
    {
        $product = $this->product->editProduct($uuidProduct);
        return response()->json($product);
    }

    /**
     * Update a product.
     *
     * Updates a specific product based on the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $uuidProduct
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProduct(Request $request, $uuidProduct)
    {
        // Get data from the incoming request
        $data = $request->all();

        // Update product in the database
        $product = $this->product->updateProduct($uuidProduct, $data);

        if ($product) {
            return response()->json($product);
        }
    }

    /**
     * Update product quantity.
     *
     * Updates the quantity of a specific product based on the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $uuidProduct
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateQuantity(Request $request, $uuidProduct)
    {
        // Get data from the incoming request
        $data = $request->all();

        // Update product quantity in the database
        $product = $this->product->updateQuantity($uuidProduct, $data);

        return response()->json($product);
    }

    /**
     * Get product price.
     *
     * Retrieves the price of a specific product.
     *
     * @param  string  $uuidProduct
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductPrice($uuidProduct)
    {
        $price = $this->product->getProductPrice($uuidProduct);
        return response()->json($price);
    }

    /**
     * Get product quantity.
     *
     * Retrieves the quantity of a specific product.
     *
     * @param  string  $uuidProduct
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductQuantity($uuidProduct)
    {
        $quantity = $this->product->getProductQuantity($uuidProduct);
        return response()->json($quantity);
    }
}

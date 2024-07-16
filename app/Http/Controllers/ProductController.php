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

    /*
      |----------------------------------------------------
      | Liste des clients
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste de tous les clients pour une entreorises 
      | spécifique qvec la possibilité de faire une recherche.
      |
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

    /*
      |----------------------------------------------------
      | Ajoût des clients
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste de tous les clients pour une entreorises 
      | spécifique qvec la possibilité de faire une recherche.
      |
     */

    public function postProduct(ProductStoreRequest $request)
    {
        Log::info($request->all());

        // Validation du formulaire
        $validated = $request->validated();

        // Get data
        $data = $request->all();

        // Insert in database
        $Data = $this->product->postproduct($data);

        if ($Data) {
            return response()->json($Data);
        }
    }

    public function editProduct($uuidProduct)
    {
        $products = $this->product->editProduct($uuidProduct);
        return response()->json($products);
    }

    public function updateProduct(Request $request, $uuidProduct)
    {
        // Get data
        $data = $request->all();
        $Data = $this->product->updateProduct($uuidProduct, $data);
        if ($Data) {
            return response()->json($Data);
        }
    }

    public function updateQuantity(Request $request, $uuidProduct)
    {
        // Get data
        $data = $request->all();
        $products = $this->product->updateQuantity($uuidProduct, $data);
        return response()->json($products);
    }

    public function getProductPrice($uuidProduct)
    {
        $products = $this->product->getProductPrice($uuidProduct);
        return response()->json($products);
    } 

    public function getProductQuantity($uuidProduct)
    {
        $products = $this->product->getProductQuantity($uuidProduct);
        return response()->json($products);
    } 
}

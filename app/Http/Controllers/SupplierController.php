<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierStoreRequest;
use App\Repositories\SupplierRepository;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected $supplier;

    public function __construct(SupplierRepository $supplier)
    {
        $this->supplier = $supplier;
    }

 

    public function getSupplier()
    {
        try {
            $suppliers = $this->supplier->getAllSuppliers();
            return response()->json($suppliers);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving suppliers.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

   

     public function postSupplier(SupplierStoreRequest $request)
     {
 
         // Form validate
         $validated = $request->validated();
 
         // Get data
         $data = $request->all();
 
         // Insert in database
         $Data = $this->supplier->postSupplier($data);
 
         if ($Data) {
             return response()->json($Data);
         }
     }
 
     public function editSupplier($uuidCustomer)
     {
         $apporteurs = $this->supplier->editSupplier($uuidCustomer);
         return response()->json($apporteurs);
     }
 
     public function updateSupplier(Request $request, $uuidCustomer)
     {
         // Get data
         $data = $request->all();
         $Data = $this->supplier->updateSupplier($uuidCustomer, $data);
         if ($Data) {
             return response()->json($Data);
         }
     }
}

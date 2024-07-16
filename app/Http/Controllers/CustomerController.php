<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Models\Customer;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customer;

    public function __construct(CustomerRepository $customer)
    {
        $this->customer = $customer;
    }

     /*
      |----------------------------------------------------
      | Customer list
      |----------------------------------------------------
      |
      | This function displays
      | a list of all customers .
      |
     */

     public function getCustomer()
     {
         try {
             $customers = $this->customer->getAllCustomers();
             return response()->json($customers);
         } catch (\Exception $e) {
             return response()->json([
                 'success' => false,
                 'message' => 'An error occurred while retrieving customers.',
                 'error' => $e->getMessage()
             ], 500);
         }
     }

    /*
      |----------------------------------------------------
      | Adding customers
      |----------------------------------------------------
      |
      | This function lets you add customers
      |
     */

    public function postCustomer(CustomerStoreRequest $request)
    {

        // Form validation
        $validated = $request->validated();

        // Get data
        $data = $request->all();

        // Insert in database
        $Data = $this->customer->postCustomer($data);

        if ($Data) {
            return response()->json($Data);
        }
    }

    public function editCustomer($uuidCustomer)
    {
        $apporteurs = $this->customer->editCustomer($uuidCustomer);
        return response()->json($apporteurs);
    }

    public function updateCustomer(Request $request, $uuidCustomer)
    {
        // Get data
        $data = $request->all();
        $Data = $this->customer->updateCustomer($uuidCustomer, $data);
        if ($Data) {
            return response()->json($Data);
        }
    }
}

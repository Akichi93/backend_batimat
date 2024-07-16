<?php

namespace App\Repositories;

use App\Models\Customer;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class CustomerRepository.
 */
class CustomerRepository extends BaseRepository
{

    protected $customers;

    public function __construct(Customer $customers)
    {
        $this->customers = $customers;
    }
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public function getAllCustomers()
    {
        return Customer::all();
    }

    public function postCustomer(array $data)
    {

        // Check if customer already exists
        if (Customer::where('firstname', $data['firstname'])->exists()) {
            return response()->json(['message' => 'Client existant'], 422);
        }

        try {
            $customers = new Customer();
            $customers->uuidCustomer = $data['uuidCustomer'];
            $customers->firstname = $data['firstname'];
            $customers->lastname = $data['lastname'];
            $customers->phone = $data['phone'];
            $customers->save();


            return response()->json($customers);
        } catch (\Exception $e) {

            return response()->json(['message' => 'An error occurred while creating the apporteur.'], 500);
        }
    }

    public function editCustomer($uuidCustomer)
    {
        $customer = Customer::where('uuidCustomer', $uuidCustomer)->first();
        return $customer;
    }

    public function updateCustomer($uuidCustomer, array $data)
    {

        $customer = Customer::where('uuidCustomer', $uuidCustomer)->first();

        if ($customer) {
            $customer->update($data);
            return $customer;
        }
    }
}

<?php

namespace App\Repositories;

use App\Models\Supplier;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class SupplierRepository.
 */
class SupplierRepository extends BaseRepository
{
    protected $suppliers;

    public function __construct(Supplier $suppliers)
    {
        $this->suppliers = $suppliers;
    }
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public function getAllSuppliers()
    {
        return Supplier::all();
    }

    public function postSupplier(array $data)
    {

        // Check if customer already exists
        if (Supplier::where('name', $data['name'])->exists()) {
            return response()->json(['message' => 'Fournisseur existant'], 422);
        }

        try {
            $suppliers = new Supplier();
            $suppliers->uuidSupplier = $data['uuidSupplier'];
            $suppliers->name = $data['name'];
            $suppliers->email = $data['email'];
            $suppliers->phone = $data['phone'];
            $suppliers->save();


            return response()->json($suppliers);
        } catch (\Exception $e) {

            return response()->json(['message' => 'An error occurred while creating the supplier.'], 500);
        }
    }

    public function editSupplier($uuidSupplier)
    {
        $supplier = Supplier::where('uuidSupplier', $uuidSupplier)->first();
        return $supplier;
    }

    public function updateSupplier($uuidSupplier, array $data)
    {

        $supplier = Supplier::where('uuidSupplier', $uuidSupplier)->first();

        if ($supplier) {
            $supplier->update($data);
            return $supplier;
        }
    }
}

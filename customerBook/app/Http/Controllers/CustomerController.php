<?php

namespace App\Http\Controllers;

use App\Repositories\CustomerRepositoryInterface;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index()
    {
        $customers = $this->customerRepository->getAllCustomers();
        return response()->json($customers);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nic' => 'required|string|unique:customers,nic|max:20',
            'address' => 'required|string|max:255',
            'contacts' => 'required|array|min:1',
            'contacts.*' => 'required|string|regex:/^[0-9]{10}$/',
        ]);

        $customer = $this->customerRepository->createCustomer($validatedData);

        return response()->json(['message' => 'Customer created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nic' => 'required|string|unique:customers,nic,' . $id . '|max:20',
            'address' => 'required|string|max:255',
            'contacts' => 'required|array|min:1',
            'contacts.*' => 'required|string|regex:/^[0-9]{10}$/',
        ]);

        try {
            $this->customerRepository->updateCustomer($id, $validatedData);
            return response()->json(['message' => 'Customer updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating customer', 'error' => $e->getMessage()], 500);
        }
    }


    public function customer($id)
    {
        $customer = $this->customerRepository->getCustomerById($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        return response()->json($customer);
    }

    public function destroy($id)
    {
        $this->customerRepository->deleteCustomer($id);
        return response()->json(['message' => 'Customer deleted successfully']);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json(['message' => 'Search query is required'], 400);
        }

        $customers = $this->customerRepository->searchCustomers($query);

        if ($customers->isEmpty()) {
            return response()->json(['message' => 'No customers found'], 404);
        }

        return response()->json($customers);
    }
}

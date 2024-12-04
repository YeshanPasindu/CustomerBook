<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Address;
use App\Models\Contact;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function getAllCustomers()
    {
        return Customer::with('address', 'contacts')->get();
    }

    public function getCustomerById($id)
    {
        return Customer::with('address', 'contacts')->find($id);
    }

    public function createCustomer(array $data)
    {
        $customer = Customer::create([
            'name' => $data['name'],
            'nic' => $data['nic'],
        ]);

        Address::create([
            'customer_id' => $customer->id,
            'address' => $data['address'],
        ]);

        foreach ($data['contacts'] as $mobile_number) {
            Contact::create([
                'customer_id' => $customer->id,
                'mobile_number' => $mobile_number,
            ]);
        }

        return $customer;
    }

    public function updateCustomer($id, array $data)
    {
        $customer = Customer::findOrFail($id);

        $customer->update([
            'name' => $data['name'],
            'nic' => $data['nic'],
        ]);

        $customer->address->update([
            'address' => $data['address'],
        ]);

        $customer->contacts()->delete();

        foreach ($data['contacts'] as $mobile_number) {
            Contact::create([
                'customer_id' => $customer->id,
                'mobile_number' => $mobile_number,
            ]);
        }

        return $customer;
    }
    public function deleteCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return $customer;
    }

    public function searchCustomers($query)
    {
        return Customer::with(['address', 'contacts'])
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('nic', 'LIKE', "%{$query}%")
            ->orWhereHas('address', function ($q) use ($query) {
                $q->where('address', 'LIKE', "%{$query}%");
            })
            ->orWhereHas('contacts', function ($q) use ($query) {
                $q->where('mobile_number', 'LIKE', "%{$query}%");
            })
            ->get();
    }
}

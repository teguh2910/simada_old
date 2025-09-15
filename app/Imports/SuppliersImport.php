<?php

namespace App\Imports;

use App\Supplier;
use App\Customer;
use Illuminate\Support\Collection;

class SuppliersImport
{
    /**
     * Process the imported data
     *
     * @param Collection $rows
     * @return void
     */
    public function handle(Collection $rows)
    {
        foreach ($rows as $row) {
            // Handle customer assignment
            $customerId = null;
            if (isset($row['customer']) && !empty($row['customer'])) {
                // Try to find customer by name first
                $customer = Customer::where('name', $row['customer'])->first();
                if ($customer) {
                    $customerId = $customer->id;
                }
            } elseif (isset($row['customer_id']) && !empty($row['customer_id'])) {
                // Use customer ID directly if provided
                $customer = Customer::find($row['customer_id']);
                if ($customer) {
                    $customerId = $customer->id;
                }
            }

            Supplier::create([
                'name' => $row['name'],
                'customer_id' => $customerId,
                'pic' => $row['pic'] ?? null,
                'no_hp' => $row['no_hp'] ?? null,
                'email' => $row['email'] ?? null,
                'presdir' => $row['presdir'] ?? null,
                'alamat' => $row['alamat'] ?? null,
                'no_telp' => $row['no_telp'] ?? null,
                'is_active' => isset($row['is_active']) ? (bool)$row['is_active'] : true,
            ]);
        }
    }

    /**
     * Get the validation rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'customer' => 'nullable|string|max:255',
            'customer_id' => 'nullable|integer|exists:customers,id',
            'pic' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'presdir' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string|max:20',
            'is_active' => 'nullable|boolean',
        ];
    }

    /**
     * Custom validation messages
     *
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'name.required' => 'Supplier name is required.',
            'name.max' => 'Supplier name cannot exceed 255 characters.',
            'customer.max' => 'Customer name cannot exceed 255 characters.',
            'customer_id.integer' => 'Customer ID must be a valid number.',
            'customer_id.exists' => 'The specified customer does not exist.',
            'email.email' => 'Please enter a valid email address.',
            'pic.max' => 'PIC name cannot exceed 255 characters.',
            'presdir.max' => 'President Director name cannot exceed 255 characters.',
        ];
    }
}
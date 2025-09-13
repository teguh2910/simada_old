<?php

namespace App\Imports;

use App\Customer;
use Illuminate\Support\Collection;

class CustomersImport
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
            Customer::create([
                'name' => $row['name'],
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
            'name.required' => 'Customer name is required.',
            'name.max' => 'Customer name cannot exceed 255 characters.',
        ];
    }
}
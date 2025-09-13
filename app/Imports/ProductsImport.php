<?php

namespace App\Imports;

use App\Product;
use Illuminate\Support\Collection;

class ProductsImport
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
            Product::create([
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
            'name.required' => 'Product name is required.',
            'name.max' => 'Product name cannot exceed 255 characters.',
        ];
    }
}
<?php

namespace App\Imports;

use App\Supplier;
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
            Supplier::create([
                'name' => $row['name'],
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
            'email.email' => 'Please enter a valid email address.',
            'pic.max' => 'PIC name cannot exceed 255 characters.',
            'presdir.max' => 'President Director name cannot exceed 255 characters.',
        ];
    }
}
<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = [
            [
                'name' => 'PT. ABC Manufacturing',
                'code' => 'ABC001',
                'email' => 'contact@abc-manufacturing.com',
                'phone' => '+62-21-1234567',
                'address' => 'Jl. Industri No. 123, Jakarta',
                'contact_person' => 'John Doe',
                'is_active' => true
            ],
            [
                'name' => 'CV. XYZ Industries',
                'code' => 'XYZ002',
                'email' => 'info@xyz-industries.com',
                'phone' => '+62-21-7654321',
                'address' => 'Jl. Teknologi No. 456, Bandung',
                'contact_person' => 'Jane Smith',
                'is_active' => true
            ],
            [
                'name' => 'PT. Global Tech',
                'code' => 'GT003',
                'email' => 'sales@globaltech.com',
                'phone' => '+62-21-9876543',
                'address' => 'Jl. Innovation No. 789, Surabaya',
                'contact_person' => 'Bob Johnson',
                'is_active' => true
            ],
            [
                'name' => 'PT. Modern Engineering',
                'code' => 'ME004',
                'email' => 'procurement@moderneng.com',
                'phone' => '+62-24-1122334',
                'address' => 'Jl. Engineering No. 321, Semarang',
                'contact_person' => 'Alice Wilson',
                'is_active' => true
            ],
            [
                'name' => 'CV. Precision Parts',
                'code' => 'PP005',
                'email' => 'orders@precisionparts.com',
                'phone' => '+62-22-4455667',
                'address' => 'Jl. Precision No. 654, Yogyakarta',
                'contact_person' => 'Charlie Brown',
                'is_active' => true
            ]
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
